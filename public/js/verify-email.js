var verify_email_form = document.getElementById('verify-email-form');
var csrf_input = document.querySelector('input[name=_token]');
var button_loader = document.getElementById('button-loader');


verify_email_form.addEventListener('submit', (event) => {
   event.preventDefault();
   button_loader.style.display = 'flex';

   let request_array = {
      'method': 'POST',
      'path': `auth/handler/verify_email`,
      'csrf_token': csrf_input.value,
      'body': {email: verify_email_form.lastElementChild.previousElementSibling.lastElementChild.previousElementSibling.value.trim()}
   };
   
   let callback_success = (data) => {
      modal_box_passcode.showModal();
      button_loader.style.display = 'none';
      html_container.style.overflowY = 'hidden';

      modal_button_passcode_yes.addEventListener('click', () => {
         let request_array = {
            'method': 'POST',
            'path': `auth/handler/verify_passcode`,
            'csrf_token': csrf_input.value,
            'body': {passcode: modal_box_passcode.firstElementChild.nextElementSibling.firstElementChild.value.trim()},
         };
      
         let callback_success = (data) => {
            modal_box_passcode.close();
            html_container.style.overflowY = 'auto';
            location.href = data.message;
         };
      
         let callback_error = (data) => {
            // toastr.error(data.message, 'Verification Error', {timeOut: 5000});
            modal_info_passcode.className = 'error';
            modal_info_passcode.innerHTML = '<i class="fa-solid fa-circle-info"></i> '+data.message;
            setTimeout(() => {
               modal_info_passcode.className = '';
               modal_info_passcode.innerHTML = '<i class="fa-solid fa-circle-info"></i> Check your email inbox or spam for the passcode';
            }, 4000);
         };
      
         ajax_update(request_array, callback_success, callback_error);
      });

      modal_box_passcode.firstElementChild
      .nextElementSibling.firstElementChild.addEventListener('keypress', (event) => {
         if(event.keyCode == 13){

            let request_array = {
               'method': 'POST',
               'path': `auth/handler/verify_passcode`,
               'csrf_token': csrf_input.value,
               'body': {passcode: modal_box_passcode.firstElementChild.nextElementSibling.firstElementChild.value.trim()},
            };
         
            let callback_success = (data) => {
               modal_box_passcode.close();
               html_container.style.overflowY = 'auto';
               location.href = data.message;
            };
         
            let callback_error = (data) => {
               // toastr.error(data.message, 'Verification Error', {timeOut: 5000});
               modal_info_passcode.className = 'error';
               modal_info_passcode.innerHTML = '<i class="fa-solid fa-circle-info"></i> '+data.message;
               setTimeout(() => {
                  modal_info_passcode.className = '';
                  modal_info_passcode.innerHTML = '<i class="fa-solid fa-circle-info"></i> Check your email inbox or spam for the passcode';
               }, 4000);
            };
            
            ajax_update(request_array, callback_success, callback_error);
         }
      });
   };
   
   let callback_error = (data) => {
      button_loader.style.display = 'none';
      toastr.error(data.message, 'Verification Error', {timeOut: 5000});
   };
   
   ajax_update(request_array, callback_success, callback_error);
});
