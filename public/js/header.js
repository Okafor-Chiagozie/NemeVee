
var search_icon = document.getElementById('search-icon');
var search_form_section = document.getElementById('search-form-section');
var search_toggle = false;

search_icon.addEventListener('click', () => {
   if(search_toggle){
      search_form_section.style.top = 'calc(-100% + 75px)';
      search_form_section.firstElementChild.firstElementChild.blur();
      search_toggle = false;
      return;
   }
   search_form_section.style.top = 'calc(0% + 75px)'; 
   search_form_section.firstElementChild.firstElementChild.focus();
   search_toggle = true;
});


var hambuger_section = document.getElementById('hambuger-section');
var nav_section = document.getElementById('nav-section');
var menu_toggle = false;

hambuger_section.addEventListener('click', () => {
   if(menu_toggle){
      hambuger_section.firstElementChild.className = "fa-solid fa-bars";
      nav_section.style.translate = '-100% 0%';
      nav_section.style.setProperty('--nav-section-before-display', 'none');
      menu_toggle = false;
      return;
   }
   hambuger_section.firstElementChild.className = "fa-solid fa-times";
   nav_section.style.translate = '0% 0%';
   nav_section.style.setProperty('--nav-section-before-display', 'flex');
   menu_toggle = true;
});