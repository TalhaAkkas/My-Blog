var counter = 1;
var limit = -1;
String.prototype.format = function (args) {
    var str = this;
    return str.replace(String.prototype.format.regex, function(item) {
        var intVal = parseInt(item.substring(1, item.length - 1));
        var replace;
        if (intVal >= 0) {
            replace = args[intVal];
        } else if (intVal === -1) {
            replace = "{";
        } else if (intVal === -2) {
            replace = "}";
        } else {
            replace = "";
        }
        return replace;
    });
};
String.prototype.format.regex = new RegExp("{-?[0-9]+}", "g");

function addInput(divName, badgeName, hidden){
    $styles = ['default','success','warning','important','info','inverse'];
    var styleNum=Math.floor(Math.random()*$styles.length)
    if (counter == limit)  {
        alert("You have reached the limit of adding " + counter + " inputs");
    }
    else {
        $divid = 'badgespan' + counter;
        var str = "<span  class='label success' onDblClick=\"onTagDblClick('{0}','{1}','{4}','{2}')\">{2}</span>"
        var newdiv = document.createElement('span');
        newdiv.innerHTML = str.format([divName, $divid ,badgeName, $styles[styleNum], hidden]);
        newdiv.style.padding = "5px 5px";
        newdiv.setAttribute("id", $divid);
        document.getElementById(divName).appendChild(newdiv);
        counter++;
    }
}
function onTagAdderClick(id, div, hidden){
    addInput(div, document.getElementById(id).value, hidden);
    document.getElementById(hidden).value = document.getElementById(hidden).value + '~' + document.getElementById(id).value + '~';
    document.getElementById(id).value='';
}
function onTagDblClick(parent, child, hidden, value){
    var d = document.getElementById(parent);
    var olddiv = document.getElementById(child);
    d.removeChild(olddiv);
    document.getElementById(hidden).value = document.getElementById(hidden).value.replace(  '~' + value + '~' ,'');
}
function addTagsOnload(str, div, hidden){
    for(value in str.split("~")){
        if(str.split("~")[value]== '')
            continue;
        addInput(div, str.split("~")[value], hidden);
        document.getElementById(hidden).value = document.getElementById(hidden).value + '~' + str.split("~")[value] + '~';
    }
}
function addTagsLinkedOnload(str, div, hidden, baseurl){
    for(value in str.split("~")){
        if(str.split("~")[value]== '')
            continue;
        addLinkedInput(div, str.split("~")[value].split("`")[0], str.split("~")[value].split("`")[1], baseurl);
    }
}
function addLinkedInput(divName, badgeName, id, baseurl){
    $styles = ['default','success','warning','important','info','inverse'];
    var styleNum=Math.floor(Math.random()*$styles.length);
    if (counter == limit)  {
        alert("You have reached the limit of adding " + counter + " inputs");
    }
    else {
        $divid = 'badgespan' + counter;
        var str = "<a href='{3}/tag/{0}'><span  class='label success' >{1}</span></a>";
        var newdiv = document.createElement('span');
        newdiv.innerHTML = str.format([id, badgeName, $styles[styleNum], baseurl]);
        newdiv.style.padding = "5px 5px";
        newdiv.setAttribute("id", $divid);
        document.getElementById(divName).appendChild(newdiv);
        counter++;
    }
}
    