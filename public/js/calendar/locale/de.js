/*!
FullCalendar v5.3.0
Docs & License: https://fullcalendar.io/
(c) 2020 Adam Shaw
*/
FullCalendar.globalLocales.push(function () {
  'use strict';

  var de = {
    code: "de",
    week: {
      dow: 1, // Monday is the first day of the week.
      doy: 4  // The week that contains Jan 4th is the first week of the year.
    },
    buttonText: {
      prev: "Zurück",
      next: "Vor",
      today: "Heute",
      year: "Jahr",
      month: "Monat",
      week: "Woche",
      day: "Tag",
      list: "Liste"
    },
    weekText: "KW",
    allDayText: "Ganztägig",
    moreLinkText: function(n) {
      return "+ weitere " + n;
    },
    noEventsText: "Keine Ereignisse anzuzeigen"
  };

  return de;

}());
