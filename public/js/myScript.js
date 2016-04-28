/**
 * Created by Minh on 21/4/2016.
 */
window.onload = function (event) {
    document.getElementById('btnClear').onclick = function(){
        x = document.getElementsByName('name');
        for (var i in x) {
            x[i].value = "";
        }
    }
}
