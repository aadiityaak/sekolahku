const global = window

global.isFileAPIAvailable = function () {
  // Check for the various File API support.
  if (window.File && window.FileReader && window.FileList && window.Blob) {
    // Great success! All the File APIs are supported.
    return true
  } else {
    // source: File API availability - http://caniuse.com/#feat=fileapi
    // source: <output> availability - http://html5doctor.com/the-output-element/
    document.writeln('The HTML5 APIs used in this form are only available in the following browsers:<br />')
    // 6.0 File API & 13.0 <output>
    document.writeln(' - Google Chrome: 13.0 or later<br />')
    // 3.6 File API & 6.0 <output>
    document.writeln(' - Mozilla Firefox: 6.0 or later<br />')
    // 10.0 File API & 10.0 <output>
    document.writeln(' - Internet Explorer: Not supported (partial support expected in 10.0)<br />')
    // ? File API & 5.1 <output>
    document.writeln(' - Safari: Not supported<br />')
    // ? File API & 9.2 <output>
    document.writeln(' - Opera: Not supported')
    return false
  }
}

// Used to generate the data for the sine wave demo
// source: http://coding.smashingmagazine.com/2011/10/04/quick-look-math-animations-javascript/
global.drawSine = function () {
  let counter = 0
  // 100 iterations
  const increase = Math.PI * 2 / 100
  for (let i = 0; i <= 1; i += 0.01) {
    const x = i
    const y = Math.sin(counter) / 2 + 0.5
    counter += increase
  }
}

jQuery(function ($) {
    // enable syntax highlighting
    hljs.initHighlightingOnLoad();

    $(document).ready(function() {
      if(isFileAPIAvailable()) {
        $('#import-csv').bind('change', handleImportSiswa);
      }
    });

    $(document).ready(function() {
      if(isFileAPIAvailable()) {
        $('#import-csv-spp').bind('change', handleImportSpp);
      }
    });

    function handleImportSiswa(event) {
      var files = event.target.files;
      var file = files[0];

      var fileInfo = `
        <span style="font-weight:bold;">${escape(file.name)}</span><br>
        - FileType: ${file.type || 'n/a'}<br>
        - FileSize: ${file.size} bytes<br>
        - LastModified: ${file.lastModifiedDate ? file.lastModifiedDate.toLocaleDateString() : 'n/a'}
      `;
      $('#file-info').append(fileInfo);

      var reader = new FileReader();
      reader.readAsText(file);
      reader.onload = function(event){

        $('#result').append(`
        <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-animated progressimport" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="`+datas('length')+`"></div>
        </div>
        <small class="detail-progress"></small>
        <textarea class="logs form-control w-100 mt-2 bg-dark text-white" rows="5"></textarea>
        `);


        importBy(1);

        function datas(index) {
          let csv = event.target.result;
          let datas = $.csv.toArrays(csv);

          if(index == 'length'){
            return datas.length - 1;
          }
          return datas[index];
        }

        function associate(keys, values){
          return keys.reduce(function (previous, key, index) {
              previous[key] = values[index];
              return previous
          }, {})
        } 
        function importBy(index){
          if(index < datas('length')){
            let keys = datas(0);
            let values = datas(index);
            let assocDatas = associate(keys, values);
            let numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
            import_ajax(index, assocDatas);
            if(numberRegex.test(assocDatas['nis']) && assocDatas['nama_siswa'] != '') {
              let percent = Math.round((index/datas('length'))*100);
              $('.progressimport').attr('aria-valuenow', index);
              $('.progressimport').attr('style','width: '+percent+'%');
              $('.progressimport').text(percent+'%');
              $('.detail-progress').text('Mengimport '+index+' dari '+datas('length')+' data.');
            } else {
              $('.logs').prepend('Data '+index+' tidak valid!\r\n');
            }
          } else if(index >= datas('length')) {
            $('.progressimport').removeClass('progress-bar-striped progress-bar-animated');
            $('.detail-progress').text('Import data selesai.');
          }
        }

        function import_ajax(index,assocDatas) {
          let datasiswa = {
            action : 'import_siswa',
            data : assocDatas,
            index :index
          };
          jQuery.post(obj.ajax_url, datasiswa, function(response) {
            console.log(response);
            $('.logs').prepend(response.nis+' - '+response.status+'\r\n');
            importBy(response.index);
          });
        }
      }
    }

    function handleImportSpp(event) {
      var files = event.target.files;
      var file = files[0];

      var fileInfo = `
        <span style="font-weight:bold;">${escape(file.name)}</span><br>
        - FileType: ${file.type || 'n/a'}<br>
        - FileSize: ${file.size} bytes<br>
        - LastModified: ${file.lastModifiedDate ? file.lastModifiedDate.toLocaleDateString() : 'n/a'}
      `;
      $('#file-info').append(fileInfo);

      var reader = new FileReader();
      reader.readAsText(file);
      reader.onload = function(event){
        var csv = event.target.result;
        var datas = $.csv.toArrays(csv);
        var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
        datas.forEach(jalankanImport);
        function jalankanImport(value, index, array) {
          setTimeout(function() {
              if(numberRegex.test(value[0])) {
                  let dataspp = {
                      action : 'import_spp',
                      data : value
                  };
                  $('#result').append('<div class="data-'+value[0]+'">Import data '+ value[0] +'  <span>diprosses!</span></div>');
                  jQuery.post(obj.ajax_url, dataspp, function(response) {
                    $('.data-'+response.nis+' span').html('<span style="color:green;">'+response.status+'!</span>');
                      setTimeout(function() {  
                        $('.data-'+response.nis).remove();
                      }, 1000);
                    });
              } else {
                  $('#result').append('<div class="data-'+value[0]+'">Data Tidak Valid!</div>');
                  setTimeout(function() {  
                    $('.data-'+value[0]).remove();
                  }, 1000);
              }
          }, index*500);
        }
      }
    }

    const ctx = document.getElementById('spp-sd').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});