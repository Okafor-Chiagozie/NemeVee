
function ajax_update(request_array, callback_success, callback_error){
   let request_option_1 = {
      method: request_array.method,
      dataType: 'json',
      headers: {
         'Content-Type': 'application/json',
         'Accept': 'application/json',
         'X-CSRF-TOKEN': request_array.csrf_token,
      },
   };

   if(request_array.method != 'GET')
      request_option_1['body'] = JSON.stringify(request_array.body);
   
   fetch(`${window.location.origin}/${request_array.path}`, request_option_1).then(response => {
      if(response.status === 422) return response.json();
      if(!response.ok) throw new Error('Error making request');

      return response.json();
   }).then( data => {
      if('errors' in data) {
         callback_error(data);
         return;
      }
      
      callback_success(data);
   })
   .catch(response => console.log(response.message));
}
