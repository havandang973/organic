var checkBoxs = document.querySelectorAll('input[type="checkbox"]')
var checkAll = document.getElementById('check-all')

var checked = false
checkAll.addEventListener('change', function () {
    checked = !checked
    checkBoxs.forEach(function(btn) {
        btn.checked = checked;
        console.log(btn)
    });
})

checkBoxs.forEach(function(btn) {
    btn.addEventListener('change', function (e) {
       console.log(btn.value)
    });
});
