var modal_box = document.getElementById('modal-box');
var modal_button_yes = document.getElementById('modal-button-yes');
var modal_button_no = document.getElementById('modal-button-no');

var modal_box_passcode = document.getElementById('modal-box-passcode');
var modal_info_passcode = document.getElementById('modal-info-passcode');
var modal_button_passcode_yes = document.getElementById('modal-button-passcode-yes');
var modal_button_passcode_no = document.getElementById('modal-button-passcode-no');

var html_container = document.querySelector('html');

modal_button_no.addEventListener('click', () => {
   modal_box.close();
   html_container.style.overflowY = 'auto';
});

modal_button_passcode_no.addEventListener('click', () => {
   modal_box_passcode.close();
   html_container.style.overflowY = 'auto';
});