
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
          Remove this if you use the .htaccess -->
          <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

          <title><?php echo $titulo_proposta; ?></title>
          <meta name="description" content="">
          <meta name="author" content="User">
          <meta name="viewport" content="width=device-width; initial-scale=1.0">

          <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
          <link rel="shortcut icon" href="/favicon.ico">
          <link rel="apple-touch-icon" href="/apple-touch-icon.png">
          
          <style type="text/css">
          body{
            font-size: 14px;
            line-height: 100%;
          }
          .nome_label{
            color: #0000CC;
            margin-right: 50px;
            margin-left: 5px;
          }
          .desc{
            font-size: 12pt; 
          }
          .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
            background: #2694E8;
            color: white;
            text-decoration: none;
            font-size: 14pt;
          }
          .bottom_div{
            border-bottom: #000000 2px solid;
          }
          /*PDF ANALISE CADASTRAL*/
          #analise_cadatral table, td{
            padding: 4px;
          }
          .tr_color{
            background: #c4c4c4;
            padding: 5px;
          }
          .text-center{
            text-align: center;
          }
          .paddind_div
          {
            padding: 4px 0 4px 0;
            background: #c4c4c4;
          }
          table{
            width: 100%;
          } 
          .tg-0lax{
            width: 50%;
          }
        </style>    
        
      </head>


      <body>
        <div class="container">
         
         <header>
           <header>
             <table style="width:100%; border: 1px solid #666666;">
               <tr>
                 <td style=" padding: 5px; margin: 5px; width:250px; ">
                   <div class="">
                     <img src="{{ public_path('dist/img/logo_grande.jpg') }}" width="64" height="32" />  
                   </div>  
                 </td>
                 <td style=" padding: 5px; margin: 5px; text-align: left;">
                  <div class="">
                   <h3><u><?php echo $titulo_proposta; ?></u></h3> 
                 </div> 
               </td>
             </tr>
           </table>          
         </header>
         <section>

          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
          <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
          <!-- Optional theme -->
          <div class="row">
            <br>
          </div>
