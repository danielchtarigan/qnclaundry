const monthNameId = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

function dateFunc(i) {
    newDate = new Date();
    let year = newDate.getFullYear();
    let month = ("0" + (newDate.getMonth() + 1)).slice(-2);
    let date = ("0" + (newDate.getDate() + i)).slice(-2);
    let thisDate = `${year}/${month}/${date}`;

    return thisDate.toString();
}

function dateFuncId(i) {
    newDate = new Date();
    let year = newDate.getFullYear();
    let month = ("0" + (newDate.getMonth() + 1)).slice(-2);
    let date = ("0" + (newDate.getDate() + i)).slice(-2);

    let thisDate = `${date}/${month}/${year}`;

    return thisDate.toString();
}

function dateLongFuncId(i) {
    newDate = new Date();
    let year = newDate.getFullYear();
    let month = monthNameId[newDate.getMonth()];
    let date = ("0" + (newDate.getDate() + i)).slice(-2);

    let thisDate = `${date} ${month} ${year}`;

    return thisDate.toString();
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