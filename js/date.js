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
        ar[0] = "������"
        ar[1] = "�������"
        ar[2] = "����"
        ar[3] = "������"
        ar[4] = "���"
        ar[5] = "����"
        ar[6] = "����"
        ar[7] = "������"
        ar[8] = "��������"
        ar[9] = "�������"
        ar[10] = "������"
        ar[11] = "�������"
        return ar[month]
}
