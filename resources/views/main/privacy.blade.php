@extends('layouts.main')

@section('content')
    <div class="mt-3">
        <h4>
            Erklärung zur Informationspflicht (Datenschutzerklärung)
        </h4>
        <p>
            Der Schutz Ihrer persönlichen Daten ist uns ein besonderes Anliegen. Wir verarbeiten Ihre Daten daher
            ausschließlich auf Grundlage der gesetzlichen Bestimmungen (DSGVO, TKG 2003). In diesen
            Datenschutzinformationen informieren wir Sie über die wichtigsten Aspekte der Datenverarbeitung im Rahmen
            unserer Website.
            Beim Besuch unserer Webseite wird Ihre IP-Adresse, Beginn und Ende der Sitzung für die Dauer dieser Sitzung
            erfasst. Dies ist technisch bedingt und stellt damit ein berechtigtes Interesse iSv Art 6 Abs 1 lit f DSGVO
            dar. Soweit im Folgenden nichts anderes geregelt wird, werden diese Daten von uns nicht weiterverarbeitet.
        </p>
        <h4>Kontakt mit uns</h4>
        <p>
            Wenn Sie per Formular auf der Website oder per E-Mail Kontakt mit uns aufnehmen, werden Ihre angegebenen
            Daten zwecks Bearbeitung der Anfrage und für den Fall von Anschlussfragen sechs Monate bei uns gespeichert.
            Diese Daten geben wir nicht ohne Ihre Einwilligung weiter.
        </p>
        <h4>Cookies</h4>
        <p>
            Unsere Website verwendet so genannte Cookies. Dabei handelt es sich um kleine Textdateien, die mit Hilfe des
            Browsers auf Ihrem Endgerät abgelegt werden. Sie richten keinen Schaden an.
            Wir nutzen Cookies dazu, unser Angebot nutzerfreundlich zu gestalten. Einige Cookies bleiben auf Ihrem
            Endgerät gespeichert, bis Sie diese löschen. Sie ermöglichen es uns, Ihren Browser beim nächsten Besuch
            wiederzuerkennen.
            Wenn Sie dies nicht wünschen, so können Sie Ihren Browser so einrichten, dass er Sie über das Setzen von
            Cookies informiert und Sie dies nur im Einzelfall erlauben.
            Bei der Deaktivierung von Cookies kann die Funktionalität unserer Website eingeschränkt sein.
        </p>
        <h4>Web-Analyse</h4>
        <p>
            Unsere Website verwendet Funktionen des Webanalysedienstes … [Name des Tools und Firma des Anbieters samt
            Unternehmenssitz einschließlich Information, ob Daten an ein (außereuropäisches) Drittland übertragen
            werden]. Dazu werden Cookies verwendet, die eine Analyse der Benutzung der Website durch Ihre Benutzer
            ermöglicht. Die dadurch erzeugten Informationen werden auf den Server des Anbieters übertragen und dort
            gespeichert.
            Sie können dies verhindern, indem Sie Ihren Browser so einrichten, dass keine Cookies gespeichert werden.
            Wir haben mit dem Anbieter einen entsprechenden Vertrag zur Auftragsdatenverarbeitung abgeschlossen.

        </p>
        <h4>Ihre Rechte</h4>
        <p>
            Ihnen stehen bezüglich Ihrer bei uns gespeicherten Daten grundsätzlich die Rechte auf Auskunft,
            Berichtigung, Löschung, Einschränkung, Datenübertragbarkeit, Widerruf und Widerspruch zu. Wenn Sie glauben,
            dass die Verarbeitung Ihrer Daten gegen das Datenschutzrecht verstößt oder Ihre datenschutzrechtlichen
            Ansprüche sonst in einer Weise verletzt worden sind, können Sie sich bei der uns [E-Mail-Adresse abgeben]
            oder der Datenschutzbehörde beschweren.
            Sie erreichen uns unter folgenden <a href="{{route('info.contact')}}">Kontaktdaten</a>
        </p>
    </div>
@endsection
