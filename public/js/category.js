
var form_select = document.getElementById('form-select');
var category_items = document.querySelectorAll('.post-section');

function checkCategories(text){
   category_items.forEach(element => {
      if(!element.getAttribute('data-attribute').toLowerCase().split(' ').includes(text) 
      && form_select.value.toLowerCase() != 'all'){
         element.style.display = 'none';
      }else{
         element.style.display = 'flex';  
      }
   });
}

form_select.value.toLowerCase(form_select.value.toLowerCase());   

form_select.addEventListener('change', () => {

   checkCategories(form_select.value.toLowerCase());
});


if(location.href.split('category/')[1]){
   for (element of form_select.children){
      if(location.href.split('category/')[1].toLowerCase() == element.textContent.toLowerCase()){

         element.selected = true;
         checkCategories(element.textContent.toLowerCase());
      }
   }
}
