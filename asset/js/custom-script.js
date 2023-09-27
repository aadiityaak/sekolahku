/**
 * Minified by jsDelivr using Terser v5.13.1.
 * Original file: /npm/print-this@1.16.0/printThis.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
!function(e){function t(e,t){t&&e.append(t.jquery?t.clone():t)}function n(t,n,i){var a,o,r,s=n.clone(i.formValues);i.formValues&&(a=s,o="select, textarea",r=n.find(o),a.find(o).each((function(t,n){e(n).val(r.eq(t).val())}))),i.removeScripts&&s.find("script").remove(),i.printContainer?s.appendTo(t):s.each((function(){e(this).children().appendTo(t)}))}var i;e.fn.printThis=function(a){i=e.extend({},e.fn.printThis.defaults,a);var o=this instanceof jQuery?this:e(this),r="printThis-"+(new Date).getTime();if(window.location.hostname!==document.domain&&navigator.userAgent.match(/msie/i)){var s='javascript:document.write("<head><script>document.domain=\\"'+document.domain+'\\";<\/script></head><body></body>")',c=document.createElement("iframe");c.name="printIframe",c.id=r,c.className="MSIE",document.body.appendChild(c),c.src=s}else{e("<iframe id='"+r+"' name='printIframe' />").appendTo("body")}var d=e("#"+r);i.debug||d.css({position:"absolute",width:"0px",height:"0px",left:"-600px",top:"-600px"}),"function"==typeof i.beforePrint&&i.beforePrint(),setTimeout((function(){i.doctypeString&&function(e,t){var n,i;(i=(n=(n=e.get(0)).contentWindow||n.contentDocument||n).document||n.contentDocument||n).open(),i.write(t),i.close()}(d,i.doctypeString);var a,r=d.contents(),s=r.find("head"),c=r.find("body"),l=e("base");a=!0===i.base&&l.length>0?l.attr("href"):"string"==typeof i.base?i.base:document.location.protocol+"//"+document.location.host,s.append('<base href="'+a+'">'),i.importCSS&&e("link[rel=stylesheet]").each((function(){var t=e(this).attr("href");if(t){var n=e(this).attr("media")||"all";s.append("<link type='text/css' rel='stylesheet' href='"+t+"' media='"+n+"'>")}})),i.importStyle&&e("style").each((function(){s.append(this.outerHTML)})),i.pageTitle&&s.append("<title>"+i.pageTitle+"</title>"),i.loadCSS&&(e.isArray(i.loadCSS)?jQuery.each(i.loadCSS,(function(e,t){s.append("<link type='text/css' rel='stylesheet' href='"+this+"'>")})):s.append("<link type='text/css' rel='stylesheet' href='"+i.loadCSS+"'>"));var p=e("html")[0];r.find("html").prop("style",p.style.cssText);var f=i.copyTagClasses;if(f&&(-1!==(f=!0===f?"bh":f).indexOf("b")&&c.addClass(e("body")[0].className),-1!==f.indexOf("h")&&r.find("html").addClass(p.className)),(f=i.copyTagStyles)&&(-1!==(f=!0===f?"bh":f).indexOf("b")&&c.attr("style",e("body")[0].style.cssText),-1!==f.indexOf("h")&&r.find("html").attr("style",p.style.cssText)),t(c,i.header),i.canvas){var m=0;o.find("canvas").addBack("canvas").each((function(){e(this).attr("data-printthis",m++)}))}if(n(c,o,i),i.canvas&&c.find("canvas").each((function(){var t=e(this).data("printthis"),n=e('[data-printthis="'+t+'"]');this.getContext("2d").drawImage(n[0],0,0),e.isFunction(e.fn.removeAttr)?n.removeAttr("data-printthis"):e.each(n,(function(e,t){t.removeAttribute("data-printthis")}))})),i.removeInline){var u=i.removeInlineSelector||"*";e.isFunction(e.removeAttr)?c.find(u).removeAttr("style"):c.find(u).attr("style","")}t(c,i.footer),function(e,t){var n=e.get(0);n=n.contentWindow||n.contentDocument||n,"function"==typeof t&&("matchMedia"in n?n.matchMedia("print").addListener((function(e){e.matches&&t()})):n.onbeforeprint=t)}(d,i.beforePrintEvent),setTimeout((function(){d.hasClass("MSIE")?(window.frames.printIframe.focus(),s.append("<script>  window.print(); <\/script>")):document.queryCommandSupported("print")?d[0].contentWindow.document.execCommand("print",!1,null):(d[0].contentWindow.focus(),d[0].contentWindow.print()),i.debug||setTimeout((function(){d.remove()}),1e3),"function"==typeof i.afterPrint&&i.afterPrint()}),i.printDelay)}),333)},e.fn.printThis.defaults={debug:!1,importCSS:!0,importStyle:!1,printContainer:!0,loadCSS:"",pageTitle:"",removeInline:!1,removeInlineSelector:"*",printDelay:333,header:null,footer:null,base:!1,formValues:!0,canvas:!1,doctypeString:"<!DOCTYPE html>",removeScripts:!1,copyTagClasses:!1,copyTagStyles:!1,beforePrintEvent:null,beforePrint:null,afterPrint:null}}(jQuery);
//# sourceMappingURL=/sm/08f200993740f04abd6475538518bcd0c33e2ec2642850f6293cda78744b33dc.map

jQuery(function ($) {
  
  $("#printButton").on("click", function () {
    console.log('Klik Tombol Berhasil');
    $("#contentToPrint").printThis({
      importCSS: true,
      importStyle: true,
      loadCSS: "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    });
  });
});

// Fungsi untuk menghasilkan angka acak 3 digit
function generateRandomNumber() {
  return Math.floor(100 + Math.random() * 900); // Angka antara 100 dan 999
}

jQuery(function ($) {
  // Menambahkan atribut readonly ke elemen input
    $('input[name="post_data[post_title]"]').prop('readonly', true);

  // Mengisi nilai elemen dengan format yang diinginkan
  var currentDate = new Date();
  var formattedDate =
    "PPDB" +
    ("0" + currentDate.getDate()).slice(-2) + // Hari (dd)
    ("0" + (currentDate.getMonth() + 1)).slice(-2) + // Bulan (mm)
    (currentDate.getFullYear() % 100) + // Tahun 2 digit terakhir (yy)
    generateRandomNumber(); // 3 angka acak

  // Mengisi nilai elemen dengan format yang dihasilkan
  $('input[name="post_data[post_title]"]').val(formattedDate);
});