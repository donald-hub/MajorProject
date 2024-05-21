document.addEventListener('DOMContentLoaded', function() {
  var dropdownItems = document.querySelectorAll('.dropdown-item');
  var dropdownButton = document.getElementById('dropdownMenu1');
  var hiddenInput = document.getElementById('userType');

  dropdownItems.forEach(function(item) {
      item.addEventListener('click', function(event) {
          event.preventDefault();
          var selectedValue = this.getAttribute('data-value');
          hiddenInput.value = selectedValue;
          dropdownButton.innerHTML = this.textContent + ' <span class="caret"></span>';
      });
  });
});