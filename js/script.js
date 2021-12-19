function updateDeleteFileDialog(filename, id){
    let label = $('#file-to-delete');
    let idPlace = $('#idNV');

    label.html(filename);
    idPlace.val(id);
}

function updateDeleteFileDialogPB(namePB, maPB) {
    let name = $('#phong-ban-to-delete');
    let ma = $('#maPB');

    name.html(namePB);
    ma.val(maPB);
}

function update_name_for_nop_task(tenTask){
    let nameTask = $('#nameToNop');

    nameTask.val(tenTask);
}

function update_name_delete_task(nameTask){
    let Task = $('#task-to-delete');
    let toDel = $('#tenToDel');
    Task.html(nameTask);
    toDel.val(nameTask);
}

function add_value_id_edit(id, name, desc, user, dead){
    let idEdit = $('#idToEdit');
    let nameEdit = $('#name');
    let descEdit = $('#desc');
    let userEdit = $('#user');
    let deadEdit = $('#dead');
    idEdit.val(id);
    nameEdit.val(name);
    descEdit.val(desc);
    userEdit.val(user);
    deadEdit.val(dead);
}

function update_name_for_duyet_task(nameTask){
    let nameToDuyet = $('#nameToDuyet');
    nameToDuyet.val(nameTask);
}

function update_name_duyet_nghi(name, id, maPB){
    let nameNV = $('#nameNvToDuyet');
    let idDon = $('#id')
    let PB = $('#maPBOfNV');

    nameNV.val(name);
    idDon.val(id);
    PB.val(maPB);
}