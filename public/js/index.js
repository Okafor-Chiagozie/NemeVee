
var subscribe_form = document.getElementById('subscribe-form');
var csrf_input = document.querySelector('input[name=_token]');

subscribe_form.addEventListener('submit', (event) => {
   event.preventDefault();

   let request_array = {
      'method': 'POST',
      'path': `handler/subscribe`,
      'csrf_token': csrf_input.value,
      'body': {email: subscribe_form.firstElementChild.nextElementSibling.value},
   };

   let callback_success = (data) => {
      subscribe_form.firstElementChild.nextElementSibling.value = '';
      toastr.success(data.message, 'Success', {timeOut: 5000});
   };

   let callback_error = (data) => {
      toastr.error(data.message, 'Subscription Error', {timeOut: 5000});
   };

   ajax_update(request_array, callback_success, callback_error);
});
