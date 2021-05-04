function activeOrNot(id){
    if(document.getElementById(id).classList.contains('show')){
    } else {
        document.getElementById('muscle').classList.remove('show');
        document.getElementById('day').classList.remove('show');
        document.getElementById('activity').classList.remove('show');
        document.getElementById(id).classList.add('show');
    }

}
