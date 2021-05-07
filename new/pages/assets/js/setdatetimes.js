const monthNameId = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

function formatDate(d) {
    let year = d.getFullYear();
    let month = ("0" + (d.getMonth() + 1)).slice(-2);
    let date = ("0" + d.getDate()).slice(-2);
    let thisDate = `${year}/${month}/${date}`;

    return thisDate.toString();
}

function formatDateId(d) {
    let year = d.getFullYear();
    let month = ("0" + (d.getMonth() + 1)).slice(-2);
    let date = ("0" + d.getDate()).slice(-2);
    let thisDate = `${date}/${month}/${year}`;

    return thisDate.toString();
}

function formatDateIdLong(d) {
    let year = d.getFullYear();
    let month = monthNameId[d.getMonth()];
    let date = ("0" + d.getDate()).slice(-2);
    let thisDate = `${date} ${month} ${year}`;

    return thisDate.toString();
}

function formatDateTimeId(d) {
    let year = d.getFullYear();
    let month = ("0" + (d.getMonth() + 1)).slice(-2);
    let date = ("0" + d.getDate()).slice(-2);
    h = ("0" + (d.getHours())).slice(-2);
    m = ("0" + d.getMinutes()).slice(-2);
    let thisDate = `${date}/${month}/${year} ${h}:${m}`;

    return thisDate.toString();
}

function setDays(days) {
    var result = new Date();
    result.setDate(result.getDate() + days);
    return result;
}

function setTimes(t) {
    var result = new Date();
    var h = result.getHours();
    result.setHours(h + t);
    return result;
}

function dayFromDateFunc(i) {
    newDate = new Date(i);
    day = newDate.getDay();

    switch (day) {
        case 0 : dayName = "Sunday";
            break;
        case 1 : dayName = "Monday";
            break;
        case 2 : dayName = "Tuesday";
            break;
        case 3 : dayName = "Wednesday";
            break;
        case 4 : dayName = "Thursday";
            break;
        case 5 : dayName = "Friday";
            break;    
        default: dayName = "Saturday";
            break;
    }

    return dayName;
}

function dayFunc() {
    newDate = new Date();
    day = newDate.getDay();

    switch (day) {
        case 0 : dayName = "Sunday";
            break;
        case 1 : dayName = "Monday";
            break;
        case 2 : dayName = "Tuesday";
            break;
        case 3 : dayName = "Wednesday";
            break;
        case 4 : dayName = "Thursday";
            break;
        case 5 : dayName = "Friday";
            break;    
        default: dayName = "Saturday";
            break;
    }

    return dayName;
}

function dayFuncId() {
    newDate = new Date();
    day = newDate.getDay();

    switch (day) {
        case 0 : dayName = "Minggu";
            break;
        case 1 : dayName = "Senin";
            break;
        case 2 : dayName = "Selasa";
            break;
        case 3 : dayName = "Rabu";
            break;
        case 4 : dayName = "Kamis";
            break;
        case 5 : dayName = "Jumat";
            break;    
        default: dayName = "Sabtu";
            break;
    }

    return dayName;
}