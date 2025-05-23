<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Visualização Vistoria - Laudo</title>
        <style>
            .tr_title{
            text-align: center;background: #D8D8D8;
            }
            .img-ambience{
            width: 221px; max-height: 200px; 
            padding: 3px;
            line-height: 1.42857143;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 18px;
            }
            .img-ambience-planta{
            width: 650px; max-height: 450px; 
            padding: 3px;
            line-height: 1.42857143;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            }
            .td_medidas{
            width: 300px;
            }
            .page-break {
            page-break-after: always;
            }
            .participantes{
            font-size: 15px;
            }
            footer { position: fixed; bottom: -50px; left: 0px; right: 0px;height: 50px; }
        </style>
        <script language="javascript">
            //window.print();
        </script>
    </head>
    <body>
        <footer>
            @for($i = 0; $i < $countLocador; $i++)

                {{ '___________ ' }}
            @endfor            
            @for($i = 0; $i < $countLocatario; $i++)

                {{ '___________ ' }}
            @endfor
            @for($i = 0; $i < $countFiador; $i++)
              
                {{ '____________ ' }}
            @endfor
        </footer>
        <table>
            <tr>
                <td style="width:30%;"><img src="{{ public_path('dist/img/nomadesite2_md.png') }}" alt="" height="64"></td>
                <td>
                    <h3>Termo de Vistoria
                        @if($survey[0]->survey_status == "Rascunho")
                        <small>({{ $survey[0]->survey_status }})</small> 
                    </h3>
                    @endif
                </td>
            </tr>
            <tr style="margin: 5px;">
                <td class="tr_title" colspan="3" ><strong> Dados da Vistoria</strong> </td>
            </tr>
            @include('survey.report.data_survey')
            <tr >
                <td class="tr_title"  colspan="3" class="text-center"> <strong>Dados do Imóvel</strong> </td>
            </tr>
            <tr>
                <td colspan="3">
                    <strong> Endereço do Imóvel: </strong>{{$survey[0]->survey_address_immobile }}                           
                </td>
            </tr>
            <tr>
                <td>
                    <strong> Tipo do imóvel: </strong>{{$survey[0]->survey_type_immobile }}                             
                </td>
            </tr>
            <tr>
                <td class="td_medidas" >
                    <strong> Medidor de Energia: </strong>{{$survey[0]->survey_energy_meter }}                          
                </td>
                <td >
                    <strong> Leitura de Energia: </strong>{{$survey[0]->survey_energy_load }}
                </td>
            </tr>
            <tr>
                <td class="td_medidas">
                    <strong> Medidor de Água: </strong>{{$survey[0]->survey_water_meter }} 
                </td>
                <td>
                    <strong> Leitura de Água: </strong>{{$survey[0]->survey_water_load }}     
                </td>
            </tr>
            <tr>
                <td class="td_medidas">
                    <strong> Medidor de Gás: </strong>{{$survey[0]->survey_gas_meter }}                          
                </td>
                <td>
                    <strong> Leitura de Gás: </strong>{{$survey[0]->survey_gas_load }}     
                </td>
            </tr>
        </table>
        @if(!empty($survey[0]->survey_general_aspects))
        <div>
            <h4 class="tr_title"><strong>Aspectos Gerais</strong></h4>
            <p>
                {!!$survey[0]->survey_general_aspects !!}
            </p>
        </div>
        @endif
        @if(!empty($survey[0]->survey_reservation))
        <div>
            <h4 class="tr_title">IV - Ressalvas por Ambientes / Cômodos</h4>
            <p>
                {!!$survey[0]->survey_reservation !!}
            </p>
        </div>
        @endif 
        <div>
            <h4 class="tr_title">V – Registros Fotográficos por Ambiente</h4>
            <p>
                @foreach($survey_update as $surveys)
            <h3 style="border-top: 2px solid #c3c3c3; margin-bottom: 5px;"> {{ $surveys[0]->ambience_name }}</h3>
            @foreach($surveys as $ambience)
            @if($ambience->files_ambience_description_file == "")
            @php $img = ""; @endphp
            @else
            <img src="{{ public_path('dist/img/upload/vistoria/'.$ambience->files_ambience_description_file)}}" class="img-ambience" >
            @endif
            @if($ambience->ambience_name == "Planta Baixa")
            <img src="{{ public_path('dist/img/upload/vistoria/'.$ambience->files_ambience_description_file) }}" class="img-ambience-planta">
            @endif
            @endforeach
            @endforeach
            @foreach($survey_update_360 as $surveys)
            <h3 style="border-top: 2px solid #c3c3c3;"> {{ $surveys[0]->ambience_name }}</h3>
            @foreach($surveys as $ambience)
            <img src="{{ public_path('dist/img/upload/vistoria/'.$ambience->files_ambience_description_file) }}" class="img-ambience">
            @endforeach
            @endforeach
            </p>
        </div>
        @if(!empty($survey[0]->survey_keys))
        <div>
            <h4 class="tr_title">VI - Chaves (e outros itens móveis)</h4>
            <p>
                {!!$survey[0]->survey_keys !!}
            </p>
        </div>
        @endif
        @if(!empty($survey[0]->survey_link_tour))
        <div>
            <h4 class="tr_title">Link para acesso ao Tour Virtual em 360º desta vistoria:</h4>
            <p style="font-size: 14px;">
                {!!$survey[0]->survey_link_tour !!}
            </p>
        </div>
        @endif 
        <div>
            <h4 class="tr_title">Disposições Gerais</h4>
            <p>
                {!!$survey[0]->survey_provisions !!}
            </p>
        </div>
        <div>   
            <br>
            <label style="margin-left: 450px;">
            {{ $data_extenso }}
            </label>
        </div>
        <br><br>
        <br><br>
        <table style="width: 600px;">
            @foreach($users as $user)
            @if($user->relation_survey_user_type == 'Locador')
            <tr>
                <td  style="width: 500px;">
                    <span style="width: 500px;"> 
                    ____________________________________________________________       
                    </span><br>
                    <strong> Locador(a): </strong>{{$user->name }} 
                    <br><br>
                </td>
            </tr>
            @endif
            @endforeach  
        </table>
        <br>
        <table style="width: 600px;">
            @foreach($users as $user)
            @if(!empty($user->relation_survey_user_type) && $user->relation_survey_user_type == 'Locatário')
            <tr>
                <td  style="width: 500px;">
                    <span style="width: 500px;"> 
                    ____________________________________________________________       
                    </span><br>
                    <strong> Locatário(a): </strong>{{$user->name }} 
                    <br><br>
                </td>
            </tr>
            @endif
            @endforeach  
        </table>
        <table style="width: 600px;">
            @foreach($users as $user)
            @if($user->relation_survey_user_type == 'Fiador')
            <tr>
                <td  style="width: 500px;">
                    <span style="width: 500px;"> 
                    ____________________________________________________________       
                    </span><br>
                    <strong> Fiador(a): </strong>{{$user->name }} 
                    <br><br>
                </td>
            </tr>
            @endif
            @endforeach  
        </table>
        <br><br>
        <table>
            <tr>
                <td>
                    <span> 
                    ______________________________________       
                    </span><br>
                    <label> Testemunha 01 CPF:</label><br>
                    <label> Nome:</label>
                </td>
                <td>
                    <span> 
                    ______________________________________       
                    </span><br>
                    <label> Testemunha 02 CPF:</label><br>
                    <label> Nome:</label>
                </td>
            </tr>
        </table>
    </body>
</html>