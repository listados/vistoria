<?php

namespace EspindolaAdm\Observers;

use EspindolaAdm\Survey;
use EspindolaAdm\SurveyHistory;
use EspindolaAdm\Enums\SurveyField;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SurveyObserver
{
    /**
     * Método chamado antes da atualização do modelo Survey.
     * Percorre os campos que foram alterados e cria um registro
     * no histórico apenas para os campos que devem ser monitorados.
     *
     * @param Survey $survey
     * @return void
     */
    public function updating(Survey $survey)
    {
        // Obtém os valores originais antes da atualização
        $original = $survey->getOriginal();

        // Obtém apenas os campos que foram modificados
        $changes = $survey->getDirty();

        foreach ($changes as $field => $newValue) {
            // Ignora campos que não devem ser monitorados
            if (!$this->shouldTrackField($field)) {
                continue;
            }

            // Valor antigo do campo (antes da atualização)
            $oldValue = $original[$field] ?? null;

            // Cria um registro na tabela survey_histories
            SurveyHistory::create([
                'survey_id' => $survey->survey_id,          // id da vistoria alterada
                'user_id' => Auth::id() ?? 1,               // usuário que fez a alteração (default 1 se não autenticado)
                'field' => SurveyField::get($field),        // nome do campo em português
                'old_value' => $oldValue,                    // valor antigo
                'new_value' => $newValue,                    // valor novo
                'changed_at' => now(),                        // data e hora da alteração
            ]);
        }
    }

    /**
     * Define quais campos devem ser monitorados no histórico.
     * Campos retornados como 'false' aqui serão ignorados.
     *
     * @param string $field Nome do campo
     * @return bool True se deve rastrear, false caso contrário
     */
    private function shouldTrackField(string $field): bool
    {
        // Campos que não fazem sentido monitorar no histórico
        $ignoredFields = ['updated_at', 'created_at'];

        return !in_array($field, $ignoredFields);
    }
}
