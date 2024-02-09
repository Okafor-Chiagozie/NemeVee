<!DOCTYPE html>
<html lang="">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>{{ $title }}</title>
   </head>

   <style>
      *{
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         overflow-x: hidden;
         color: red !important;
      }
      
      .main{
         width: 100%;
         height: auto;
         margin-inline: 1%;
         padding-inline: 1%;
         background-color: rgba(0, 0, 0, 0.1);
         display: flex;
         flex-direction: column;
         justify-content: flex-start;
         align-items: center;
      }

      .main .content{
         display: flex;
         flex-direction: column;
         /* justify-content: flex-start; */
      }

      .main .content > *,
      .main .content > * > *,
      .main .content > * > * > *{
         overflow: visible;
         margin-left: 2rem;
      }


   </style>

   <body>
      <main class="main">
         <h1>{{ $title }}</h1>

         <section class="content">
            <p>{!! $content !!}</p>
         </section>
      </main>
   </body>
</html>