
$(document).ready(function(){
  var row;
  jQuery.ajax({
      type: "POST",
      url: 'sql.php',
      dataType: 'json',
      data: {functionname: selectEPS_DataLocationSQL, arguments: []},

      success: function (data) {
        $.each(data, function(key, value){
          row.push(value);
          }
      }
  });


  $( function() {
      $( "#startDate" ).datepicker({
          onSelect: function(selected) {
              $("#endDate").datepicker("option","minDate", selected);
          }
      });
      $( "#endDate" ).datepicker({
          onSelect: function(selected) {
              $("#startDate").datepicker("option","maxDate", selected);
          }
      });
  });


  $( function(){
    $( "#location" )
            .selectmenu()
            .selectmenu( "menuWidget" )
                .addClass( "overflow");

  });

  row.forEach(addingOptions);

  function addingOptions(item, index) {
    var x = document.getElementById("locationo");
    var option = document.createElement("option");
    option.text = row[index];
    x.add(option);
  }
  /*
      document.getElementById("filterCrimeBtn").onclick = function(){
          }
  */
      /* End */

}];
