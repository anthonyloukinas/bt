var url = window.location;
$('ul.nav a').filter(function(){
  return this.href == url;
}).parent().addClass('active');

var urlx = window.location;
$('div.list-group a').filter(function(){
  return this.href == urlx;
}).addClass('active main-color-bg');
