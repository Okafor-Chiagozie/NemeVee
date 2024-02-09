
var to_top_button = document.getElementById('to-top-button');

window.addEventListener('scroll', function(){
   if(this.document.documentElement.scrollTop > window.innerHeight){
      to_top_button.style.translate = '0% 0%';
   }else{
      to_top_button.style.translate = '250% 0%';
   }
});
