var profile_icon = document.getElementById('profile-icon');
var admin_menu = document.getElementById('admin-menu');
var menu_toggle = false;

profile_icon.addEventListener('click', () => {
   if(menu_toggle){
      admin_menu.style.translate = 'calc(100% + 15px) 0%';
      menu_toggle = false;
      return;
   }
   admin_menu.style.translate = 'calc(0% - 2px) 0%';
   menu_toggle = true;
});