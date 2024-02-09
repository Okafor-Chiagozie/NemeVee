
var toogle_section = document.getElementById('toogle-section');
var post_sections = document.getElementsByClassName('post-section');

function loopThroughPostSection(text){
   if(text == 'published'){
      for (let index = 0; index < post_sections.length; index++) {
         if(post_sections[index].firstElementChild.nextElementSibling.firstElementChild.firstElementChild.textContent.trim() == 'draft'){
            post_sections[index].style.display = 'none';
         }else{
            post_sections[index].style.display = 'flex';
         }
      }
      return;
   }

   if(text == 'draft'){
      for (let index = 0; index < post_sections.length; index++) {
         if(post_sections[index].firstElementChild.nextElementSibling.firstElementChild.firstElementChild.textContent.trim() != 'draft'){
            post_sections[index].style.display = 'none';
         }else{
            post_sections[index].style.display = 'flex';
         }
      }
      return;
   }

   if(text == 'editor'){
      for (let index = 0; index < post_sections.length; index++) {
         if(!post_sections[index].getAttribute('class').toLowerCase().split(' ').includes(text)){
            post_sections[index].style.display = 'none';
         }else{
            post_sections[index].style.display = 'flex';
         }
      }
      return;
   }
   
   if(text == 'normal'){
      for (let index = 0; index < post_sections.length; index++) {
         if(!post_sections[index].getAttribute('class').toLowerCase().split(' ').includes(text)){
            post_sections[index].style.display = 'none';
         }else{
            post_sections[index].style.display = 'flex';
         }
      }
      return;
   }
}

loopThroughPostSection('published');


toogle_section.firstElementChild.addEventListener('click', () => {
   loopThroughPostSection('draft');
   for (const child of toogle_section.children) {
      child.className = '';
   }
   toogle_section.firstElementChild.className = 'selected';
   
});

toogle_section.firstElementChild.nextElementSibling.addEventListener('click', () => {
   loopThroughPostSection('published');
   for (const child of toogle_section.children) {
      child.className = '';
   }
   toogle_section.firstElementChild.nextElementSibling.className = 'selected';
});

toogle_section.lastElementChild.previousElementSibling.addEventListener('click', () => {
   loopThroughPostSection('editor');
   for (const child of toogle_section.children) {
      child.className = '';
   }
   toogle_section.lastElementChild.previousElementSibling.className = 'selected';
});

toogle_section.lastElementChild.addEventListener('click', () => {
   loopThroughPostSection('normal');
   for (const child of toogle_section.children) {
      child.className = '';
   }
   toogle_section.lastElementChild.className = 'selected';
});





