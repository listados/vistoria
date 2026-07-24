# Reescrita em Laravel 13 — escopo reduzido (Auth + Vistoria + Admin/Ambience)

## Contexto

Pivot em relação ao plano anterior (upgrade incremental 5.6→6.0): a decisão agora é **reescrever do zero em Laravel 13**, restringindo o escopo às rotas que o usuário confirmou:
- `prefix('vistoria')` (todo o fluxo de inspeção)
- `files_ambience/show/{id}`
- `prefix('usuario')`
- `prefix('admin')` (configurações + cadastro de ambientes)

Fora do escopo: Chaves/Reserva, Escolha Azul (Proposta PF/Fiador), Delivery, Team/Site/Contato, sincronização de Imóveis (XML). Essa redução é real e significativa — o app legado tem 9 domínios, ficam 3 (Auth/Usuário, Vistoria, Admin/Configuração) + 1 endpoint auxiliar (files_ambience).

**Resposta à pergunta "acredita que é rápido no Laravel 13?"**: parcialmente sim, mas com uma ressalva importante. A redução de escopo (excluir 6 dos 9 domínios) é o que realmente torna isso viável — não o fato da "vistoria" em si ser simples. A investigação profunda dos 3 domínios mantidos mostrou que o domínio de Vistoria **não é trivial**:
- `SurveyController` tem 1139 linhas e 16+ métodos com regras de negócio entrelaçadas (workflow de status, replicação com regra especial de descarte de locatário/fiador, upload de fotos normais e 360°, reordenação de fotos via SQL raw `ORDER BY FIELD(...)`, geração de PDF com contagem dinâmica de linhas de assinatura).
- **Nenhuma relação Eloquent está definida** em nenhum model do domínio (`Survey`, `FilesAmbience`, `OrderAmbienceSurvey`, `RelSurveyUser`) — tudo hoje é `DB::table` cru com joins manuais repetidos em quase todo método. Recriar isso com Eloquent de verdade (que é o caminho certo para um projeto novo) é trabalho real, não cópia.
- **Dois sistemas de histórico coexistem** (`history_survey` legado alimentado manualmente + `survey_histories` novo alimentado por Observer, só quando o save passa por Eloquent) — o fluxo principal de salvar vistoria (`update()`) usa query builder e **não** dispara o Observer, então hoje a auditoria é inconsistente dependendo de qual tela salvou. Unificar isso é uma decisão de arquitetura, não um copy-paste.
- Achados de dívida técnica que precisam de decisão (ver seção "Bugs e pendências"): rota morta, CRUD incompleto, middleware de admin nunca aplicado, bug de copy-paste em view, import morto, coluna referenciada que não bate com a migration.

Ou seja: **é bem mais rápido que migrar o app inteiro**, mas ainda é um projeto de tamanho médio — não um "fim de semana". O ganho real de velocidade vem de descartar 6 domínios e de não ter que lidar com as dependências mais frágeis do legado (yajra/Datatables legado, laravelcollective/html, adminlte antigo) força-bruta — no projeto novo elas simplesmente não entram do jeito antigo.

## Decisões já confirmadas com o usuário

1. **Corrigir os bugs/pendências identificados** durante a reescrita (não replicar 1:1) — unificar histórico, aplicar restrição de admin de fato, completar CRUD de Ambience, remover rotas/views mortas, corrigir bug de copy-paste.
2. **Modernizar o schema do banco**: nomes de tabela/coluna convencionais para Eloquent, FKs reais entre `survey`, `files_ambience`, `relation_survey_user`, `order_ambience_survey`, `survey_histories`. Isso implica que a carga de dados do dump SQL (a chegar) será um **script de transformação**, não um import direto.
3. **Frontend adiado**: focar primeiro em rotas/controllers/models/migrations no Laravel 13; decidir depois se os componentes Vue são portados para Vue 3 + Vite (recomendado, já que Laravel 13 vem com Vite por padrão e o Mix está descontinuado) ou se a UI é refeita.

## Escopo funcional a portar

### 1. Auth + Usuário
- Login/registro/recuperação de senha: hoje é **100% o scaffold padrão do Laravel 5.6** (`Auth::routes()`), sem nenhuma customização real nos 4 controllers de Auth — só o `$redirectTo` já é o próprio default. As 4 telas (`login`, `register`, `passwords/email`, `passwords/reset`) vêm inteiramente do pacote `jeroennoten/laravel-adminlte` (`@extends('adminlte::login')` etc, sem overrides de campo). No Laravel 13 isso deve ser recriado com **Laravel Breeze** (ou Fortify) — baixo risco, é literalmente o caso de uso padrão do Breeze.
- Registro hoje só grava `name`/`email`/`password` (os demais campos do model `User` ficam nulos) — decidir se o registro público continua existindo no projeto novo ou se a criação de usuário passa a ser só via admin (dado que o campo `adm`/perfil sugere que nem todo usuário deveria poder se autorregistrar).
- Model `User`: campos a manter — `name`, `email`, `password`, `nick`, `id_profile`, `status`, `phone`, `receive_proposal`, `avatar`, `adm`, `cpf`.
- `UserController` (rotas `usuario/editar/{id}` GET/PUT) tem bugs a corrigir na reescrita:
  - `update()` ignora o `{id}` da rota e usa um campo hidden do formulário para achar o usuário — trocar por resolução via rota (route-model binding).
  - Variável `$user_adm = Auth::user()->adm` é lida e nunca usada — remover ou, se a intenção era restringir campos editáveis por admin, implementar de fato.
  - Campos `nick`, `phone`, `receive_proposal` aparecem no formulário mas não são salvos — decidir se devem passar a ser salvos.
  - Mensagem de sucesso é exibida mesmo quando cai no `catch` (erro mascarado como sucesso) — corrigir.
  - Avatar é uma imagem hardcoded (URL externa fixa), sem upload real — decidir se vira upload de verdade via `Storage`.
- Trocar `Form::`/`Html::` (laravelcollective) por Blade puro nas views de usuário.

### 2. Vistoria (Survey) — domínio principal

Módulos funcionais a recriar (hoje tudo dentro de um único `SurveyController` de 1139 linhas — recomendo quebrar em controllers menores por responsabilidade):

- **CRUD/listagem/busca de vistoria**: criar, editar, listar (a versão legada com jQuery Datatables deve ser **descartada** — já existe uma versão via Vue/API mais nova convivendo em paralelo), buscar por código/tipo/status/vistoriador/endereço.
- **Gestão de pessoas da vistoria** (locador/locatário/fiador): hoje modelada como registros na própria tabela `users` do sistema (perfil fixo, senha aleatória) ligados via `relation_survey_user` com uma coluna `type`. Decisão de modelagem para o projeto novo: separar isso em uma entidade própria (ex. `SurveyParticipant`), já que "pessoa da vistoria" não é um usuário do sistema (não loga, não tem senha de verdade) — recomendo essa separação como parte da modernização de schema já decidida.
- **Upload de fotos** (normais e 360°): hoje via `$_FILES`/`move_uploaded_file` direto para `public/dist/img/upload/vistoria/`, fora do filesystem abstraído do Laravel — recriar via `Storage` (disco `public` ou `s3`). A feature de foto 360° grava dimensões em uma tabela `configuration_image` que **não tem migration no repositório** — preciso confirmar no dump SQL se essa tabela existe de fato em produção antes de decidir se a feature é recriada.
- **Reordenação de fotos por ambiente**: hoje via uma string CSV de ids salva em `order_ambience_survey_list_order` e `ORDER BY FIELD(...)` em SQL puro — modernizar para uma coluna de posição numérica numa tabela pivot de verdade.
- **Reclassificação/exclusão em lote de fotos por ambiente**.
- **Geração de PDF do laudo** (`barryvdh/laravel-dompdf`): monta contagem dinâmica de assinantes por tipo para desenhar linhas de assinatura, data por extenso em português, numeração de página customizada. Lógica de montagem de dados é a parte que mais vale a pena preservar tal como está (é regra de negócio validada, não bug).
- **Replicar vistoria**: clona dados da vistoria + fotos, mas **descarta os clones de locatário/fiador** (mantém só locador) — regra de negócio a preservar exatamente.
- **Arquivar vistoria** (soft-hide da listagem).
- **Histórico de alterações**: unificar em uma única tabela (`survey_histories`), alimentada de forma consistente independente de qual tela/fluxo salvou a vistoria — isso exige que toda escrita relevante passe por Eloquent (ou por um serviço central que registra o histórico explicitamente), não por `DB::table(...)->update()` cru como acontece hoje no fluxo principal.
- **Textos-padrão do laudo por vistoria** (aspecto geral, ressalva, disposição geral, chaves): editáveis por vistoria via editor rich-text, com valor inicial copiado da configuração global (domínio Admin, ver abaixo) no momento da criação.
- **Workflow de finalização**: hoje é literalmente um botão que faz `PUT` setando `status = 'Finalizada'`, sem validação extra de completude — replicar como está é suficiente, mas vale decidir se o projeto novo quer alguma validação mínima antes de permitir finalizar.

**Bugs/pendências encontrados nesse domínio a decidir/corrigir:**
- Rota `vistoria/nova-vistoria/{id}` chama `edit($id, $action)`, que exige 2 parâmetros — rota provavelmente morta, confirmar antes de descartar.
- Import de `SurveyRequest` nunca usado (código morto) — a validação real de "nome do locador obrigatório" hoje é feita manualmente dentro do `update()`, não via FormRequest.
- `Ambience::getNameAmbience()` tem bug lógico (usa retorno de `array_push` incorretamente) e não parece ter uso real — candidato a não portar.
- Views de laudo órfãs (`report/view_photo.blade.php`, `report/view_survey.blade.php.save`) não referenciadas por nenhum controller atual — não portar sem confirmar com o time que ninguém mais usa.
- Bug de copy-paste em `survey/create.blade.php`: os editores de "ressalva" e "chaves" usam por engano o valor de `survey_provisions` no atributo inicial (o JS carrega o valor certo via API depois, então o efeito é só cosmético, mas vale corrigir).
- `allSurvey()` (endpoint usado pela listagem Vue) não filtra vistorias arquivadas (`survey_filed`), enquanto a listagem legada filtra — inconsistência a resolver (decidir qual comportamento é o correto).

### 3. Admin / Configuração + Ambiente

- **Configurações globais** (hoje uma única linha singleton na tabela `settings`): 4 textos-padrão do laudo (aspecto geral, ressalva, disposição geral, chaves) que servem de valor inicial para cada nova vistoria. A tabela atual também tem colunas de sincronização de imóveis (`settings_date_last_sync`, `settings_total_immobile_sync`, `settings_id_user_sync`) — **essas pertencem ao domínio de Imóveis, que está fora do escopo pedido**; recomendo não portar essas colunas para o schema novo (confirmar com o usuário).
- **Cadastro de Ambientes** (lista mestre reutilizada como dropdown no fluxo de vistoria — upload de fotos, reclassificação de fotos, ordenação): hoje o `AmbienceController` só implementa `store`/`update`/`all`, mas o `Route::resource` registra `index/create/show/edit/destroy` que **não existem** (chamar essas rotas quebra o app hoje) — completar o CRUD de verdade no projeto novo.
- **Bugs/pendências a corrigir:**
  - `SettingController@edit` (endpoint que salva as configurações) referencia uma coluna `settings_id` que **não existe** na migration atual (a PK se chama só `settings`) — precisa confirmar contra o schema real do banco de produção (dump SQL) antes de reescrever esse endpoint.
  - Rota `configuracao/chaves` aponta para um método `keys()` **inexistente** no controller — feature nunca finalizada, não há view nem tela associada. Decidir: remover essa rota ou implementar a tela de verdade.
  - Middleware `Settings` (que checa `adm == 1`) existe como classe mas **nunca é aplicado a nenhuma rota** — hoje qualquer usuário autenticado acessa as telas de admin. Aplicar de fato no projeto novo (decisão já confirmada de corrigir bugs).
  - `GET /api/setting/` é pública e expõe a linha inteira da tabela `settings` sem autenticação — revisar exposição de dados no endpoint equivalente novo.
  - Botão "salvar novo ambiente" no componente Vue de cadastro de ambientes não tem handler funcional ligado (depende de um script jQuery legado que não é carregado nessa tela) — corrigir ao portar.

### 4. Files Ambience
- Único endpoint (`show`) que lista fotos "normais" (exclui 360°) de uma vistoria, hoje via join manual — trivial de portar com relações Eloquent reais.

## Dependências para o projeto novo

- **`barryvdh/laravel-dompdf`** — manter, versão atual compatível com Laravel 13.
- **`jeroennoten/laravel-adminlte`** — manter se o visual AdminLTE for preservado (decisão de frontend adiada); confirmar na hora se há release compatível com Laravel 13.
- **`yajra/laravel-datatables-oracle`** — dentro do escopo reduzido, hoje só é usado pela listagem **legada** de vistoria (a ser descartada) e por `SettingController@getAmbience`. Bem provável que o projeto novo **não precise mais dessa dependência** — as listagens relevantes já têm equivalente via Vue + endpoint JSON próprio.
- **`laravelcollective/html`** — não portar; usar Blade puro (`@csrf`, `<form>`, helpers nativos), consistente com a decisão já tomada no plano de upgrade anterior.
- **Carbon** — já vem embutido com o Laravel, não precisa instalar à parte.
- **Laravel Breeze** (ou Fortify) — para o scaffolding de Auth.

## Estrutura de dados — próximos passos

Aguardando o dump SQL do usuário para:
1. Confirmar o schema real de produção (em especial: nome real da PK/coluna referenciada por `SettingController@edit`; existência real da tabela `configuration_image`; consistência dos dados em `relation_survey_user`/`files_ambience`/`order_ambience_survey`, que hoje não têm FK/constraint no banco).
2. Desenhar as migrations novas com nomenclatura modernizada e FKs reais (conforme decidido).
3. Desenhar os models com relações Eloquent de verdade (`Survey::filesAmbience()`, `Survey::participants()`, `Survey::orderAmbience()`, `Survey::histories()`, etc).
4. Escrever um script de transformação/carga de dados (dump antigo → schema novo) — não será um import direto de tabela, e sim um mapeamento explícito.

## Plano de ação (fases)

1. **Bootstrap do projeto** — novo projeto Laravel 13, Breeze, `jeroennoten/laravel-adminlte` (se mantido), `barryvdh/laravel-dompdf`, configuração inicial de ambiente/Docker.
2. **Auth + Usuário** — telas de login/registro/reset via Breeze customizado visualmente para AdminLTE; `UserController` reescrito com as correções listadas.
3. **Modelagem de dados do domínio Vistoria** — assim que o SQL chegar: migrations + models com relations, decidindo a separação `SurveyParticipant` vs `User`.
4. **Domínio Vistoria** — controllers quebrados por responsabilidade (CRUD/busca, participantes, fotos/upload/ordenação, PDF, histórico unificado), preservando as regras de negócio validadas (replicação, workflow de finalização, geração de laudo).
5. **Domínio Admin/Configuração + Ambiente** — `SettingController`/`AmbienceController` reescritos, CRUD de Ambience completo, restrição de admin aplicada de fato.
6. **Script de migração de dados** — dump antigo → schema novo.
7. **Frontend** — decisão adiada; retomar quando o backend estiver de pé (Vue 3 + Vite vs. alternativa).
8. **Validação de paridade** — testes manuais ponta a ponta comparando com o comportamento do sistema antigo (exceto nos pontos que foram deliberadamente corrigidos).

## Verificação

Diferente do legado (que não tem cobertura de testes real), o projeto novo deve nascer com testes de Feature (PHPUnit ou Pest) cobrindo pelo menos: login/registro, CRUD de vistoria, upload e reordenação de fotos, geração de PDF, replicação, arquivamento, edição de usuário, e CRUD de ambiente/configuração — isso substitui a dependência de checklist manual que o plano de upgrade anterior precisava (lá não dava para adicionar testes de baixo custo num legado tão grande; aqui, sendo código novo, o custo de já nascer testado é baixo).

## Pontos em aberto (dependem do dump SQL ou de confirmação do usuário)

- Existência real da tabela `configuration_image` (fotos 360°) em produção.
- Confirmar a coluna real usada por `SettingController@edit` (a migration atual não bate com o código).
- Decidir o destino da rota/feature `configuracao/chaves` (nunca finalizada) — remover ou implementar.
- Confirmar remoção das colunas de sincronização de imóveis da tabela `settings` (fora do escopo de rotas pedido).
- Confirmar se o registro público de usuário deve continuar existindo no projeto novo.
