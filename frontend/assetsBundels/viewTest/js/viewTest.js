var selectLists = document.getElementsByName('norm_select');

for (i = 0; i < selectLists.length; i++) {
    selectLists[i].addEventListener('change', showNormDiff, true);
}

function showNormDiff() {
    if (this.value !== '') {
        $(this).next().find('#selected').text(this.value)
        var total = parseFloat($(this).next().find('#category').text() - this.value).toFixed(2);
        $(this).next().find('#total').text(total);
        $(this).next().show();
    } else {
        $(this).next().hide();
    }
}