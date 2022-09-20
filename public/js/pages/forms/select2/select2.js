var countries = [{
    "id": 1,
    "text": "Greece",
    "children": [{
      "id": "Athens",
      "text": "Athens"
    }, {
      "id": "Thessalonica",
      "text": "Thessalonica"
    }]
  }, {
    "id": 2,
    "text": "Italy",
    "children": [{
      "id": "Milan",
      "text": "Milan"
    }, {
      "id": "Rome",
      "text": "Rome"
    }]
  }];
  
  $('#selectcountry').select2({
    placeholder: "Please select cities",
    allowClear: true,
    width: '100%',
    data: countries
  });
  
  $('#selectcountry').on('select2:open', function(e) {
  
    $('#select2-selectcountry-results').on('click', function(event) {
  
      event.stopPropagation();
      var data = $(event.target).html();
      var selectedOptionGroup = data.toString().trim();
  
      var groupchildren = [];
  
      for (var i = 0; i < countries.length; i++) {
  
  
        if (selectedOptionGroup.toString() === countries[i].text.toString()) {
  
          for (var j = 0; j < countries[i].children.length; j++) {
  
            groupchildren.push(countries[i].children[j].id);
  
          }
  
        }
  
  
      }
  
  
      var options = [];
  
      options = $('#selectcountry').val();
  
      if (options === null || options === '') {
  
        options = [];
  
      }
  
      for (var i = 0; i < groupchildren.length; i++) {
  
        var count = 0;
  
        for (var j = 0; j < options.length; j++) {
  
          if (options[j].toString() === groupchildren[i].toString()) {
  
            count++;
            break;
  
          }
  
        }
  
        if (count === 0) {
          options.push(groupchildren[i].toString());
        }
      }
  
      $('#selectcountry').val(options);
      $('#selectcountry').trigger('change'); // Notify any JS components that the value changed
      $('#selectcountry').select2('close');    
  
    });
  });