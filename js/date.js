function leapYear(year) 
{
        if (year % 4 == 0) // basic rule
                return true // is leap year
                return false // is not leap year
}

function getDays(month, year) 
{
        var ar = new Array(12)
        ar[0] = 31 // January
        ar[1] = (leapYear(year)) ? 29 : 28 // February
        ar[2] = 31 // March
        ar[3] = 30 // April
        ar[4] = 31 // May
        ar[5] = 30 // June
        ar[6] = 31 // July
        ar[7] = 31 // August
        ar[8] = 30 // September
        ar[9] = 31 // October
        ar[10] = 30 // November
        ar[11] = 31 // December
        return ar[month]
}

function getMonthName(month) 
{
        var ar = new Array(12)
        ar[0] = "Январь"
        ar[1] = "Февраль"
        ar[2] = "Март"
        ar[3] = "Апрель"
        ar[4] = "Май"
        ar[5] = "Июнь"
        ar[6] = "Июль"
        ar[7] = "Август"
        ar[8] = "Сентябрь"
        ar[9] = "Октябрь"
        ar[10] = "Ноябрь"
        ar[11] = "Декабрь"
        return ar[month]
}
