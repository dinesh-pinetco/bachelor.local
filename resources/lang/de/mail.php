<?php

return [
    'welcome' => 'Moin  :name',

    'new-user' => [
        'subject' => 'Willkommen im Bewerbungsportal der Nordakademie!',
        'body1' => '<br>  vielen Dank für Ihr Interesse an einem berufsbegleitenden Masterstudium an der NORDAKADEMIE!',
        'body2' => '<br>  Im Folgenden erhalten Sie Ihre Zugangsdaten der NORDAKADEMIE, die Sie im weiteren Verlauf der Bewerbung benötigen.',
        'body3' => '<br> Die Daten sind sowohl für unseren Auswahltest als auch unser Masterportal gültig, in welchem Sie Ihre Angaben jederzeit anpassen können.',
        'body4' => '<br> Über die weiteren Schritte des Bewerbungsprozesses informieren wir Sie gesondert per E-Mail nach Erhalt Ihrer <b>Bewerbungsunterlagen</b>.',
        'action' => 'Login',
        'email' => '<br> Anmeldename. <strong> :email </strong>',
        'password' => '<br> Passwort. <strong> :password </strong>',
    ],

    'new-employee' => [
        'subject' => 'Herzlich willkommen auf dem Bewerbungsportal der Nordakademie!',
        'body1' => '<br> Sie können diese Anmeldedaten für die Anmeldung in credential verwenden',
        'action' => 'Anmeldung',
        'email' => '<br> E-Mail. <strong> :email </strong>',
        'password' => '<br> Password. <strong> :password </strong>',
    ],

    'reset-password' => [
        'subject' => 'Passwort zurücksetzen',
        'body' => '<br> Sie erhalten diese E-Mail, weil wir eine Anfrage zum Zurücksetzen des Passworts für Ihr Konto erhalten haben.',
        'paragraph1' => '<br> Dieser Link zum Zurücksetzen des Passworts wird in 60 Minuten ablaufen.',
        'paragraph2' => '<br> Wenn Sie keine Rücksetzung des Passworts beantragt haben, sind keine weiteren Schritte erforderlich.',
        'action' => 'Passwort zurücksetzen',
    ],

    'application-approved' => [
        'subject' => 'Bewerbung genehmigt',
        'body' => '<br>gute Nachrichten! <br> Wir haben Ihre Bewerbung gerade geprüft und Sie für unsere Auswahltests freigeschaltet.',
        'body2' => 'Diese finden Sie im Bewerbungsportal unter dem Reiter Auswahltests oder gelangen direkt über diesen Button dorthin.',
        'paragraph1' => '<br>Nehmen Sie sich für den Auswahltest ausreichend Zeit (ca. 2 Stunden) und sorgen Sie für eine ungestörte Arbeitsumgebung.',
        'paragraph2' => '<br>Unser Tipp für Sie: Am besten ist der Test am PC/Laptop mit einer Maus durchzuführen.',
        'paragraph3' => '<br>Nachdem Sie den Test absolviert haben, melden wir uns zeitnah bei Ihnen mit einem Terminvorschlag für das Auswahlgespräch mit unserer Studiengangsleitung bzw. wissenschaftlichen Mitarbeitenden. Das Gespräch dient nicht nur dem weiteren Kennenlernen, sondern auch einem Feedback zu Ihren Testergebnissen.',
        'paragraph4' => '<br>Sollten Sie in der Zwischenzeit Fragen haben, melden Sie sich jederzeit bei uns. ',
        'paragraph5' => '<br>Viel Erfolg beim Auswahltest und mit besten Grüßen von der Elbe ',
        'action' => 'Hier geht es zum Auswahltest',
    ],

    'new-application-approved' => [
        'paragraph1' => '<br> gute Nachrichten! <br> Wir haben Ihre Bewerbung gerade geprüft und akzeptiert!',
        'paragraph2' => '<br> Da Sie Ihren Bachelor bereits an der NORDAKADEMIE gemacht haben, müssen Sie den Auswahltest nicht noch einmal absolvieren, sondern „springen“ gleich zum Auswahlgespräch mit unserer Studiengangsleitung bzw. wissenschaftlichen Mitarbeitenden.',
        'paragraph3' => '<br> Geben Sie uns hierfür bitte einige Tage Zeit, bis wir mit einem Terminvorschlag auf Sie zukommen.',
        'paragraph4' => '<br> Sollten Sie in der Zwischenzeit Fragen haben, melden Sie sich jederzeit bei uns. ',
        'paragraph5' => '<br> Mit den besten Grüßen von der Elbe. ',
    ],

    'application-received' => [
        'subject' => 'Antrag eingegangen',
        'body' => '<br> vielen Dank für Ihre Bewerbungsunterlagen, deren Eingang wir Ihnen hiermit bestätigen.',
        'body2' => 'Im nächsten Schritt prüfen wir Ihre Bewerbungsunterlagen. Dies kann gegebenenfalls einige Tage in Anspruch nehmen.',
        'body3' => 'Sobald wir Ihre Bewerbung akzeptiert haben, werden Sie von uns für unseren Auswahltest freigeschaltet und darüber in einer separaten E-Mail informiert.',
        'body4' => 'Wir haben Ihre Unterlagen sorgfältig geprüft und würden Sie im nächsten Schritt gerne weiter kennenlernen. Unseren Auswahltest haben wir soeben für Sie freigeschaltet. ',
        'body5' => 'Sollten Sie in der Zwischenzeit Fragen haben, melden Sie sich jederzeit bei uns.',
        'paragraph1' => '<br> Jetzt können Sie sie überprüfen und für den Test freigeben.',
        'action' => 'Zu den Details des Bewerbers',
    ],

    'contract-received' => [
        'subject' => 'Vertrag erhalten',
        'body' => '<br> Ihr Vertrag wurde erfolgreich empfangen.',
        'paragraph1' => '<br> Ihr unterschriebener Vertrag ist heute bei uns eingegangen.',
        'paragraph2' => '<br> Nun ist es nur noch ein kleiner Schritt, bis Sie mit Ihrem Studium beginnen können.',
        'paragraph3' => '<br> Vorbereitend benötigen wir noch zusätzliche Informationen von Ihnen, die Sie uns online übermitteln können. Dort können Sie Ihre Zahlungsdaten oder eine alternative Rechnungsadresse angeben.',
        'paragraph4' => '<br> Bitte füllen Sie die Bögen schnellstmöglich aus, da Ihre Immatrikulation nur nach ausgefülltem Studienbegleitbogen und der Erfassung der Daten für das Statistische Landesamt durchführbar ist! ',
        'paragraph5' => '<br> Rechtzeitig vor Studienbeginn erhalten Sie per Post Ihre Zugangsdaten für Ihren NORDAKADEMIE-Account. Über diesen Account erhalten Sie wichtige Informationen, wie z.B. zur ersten Präsenzphase oder Ihren Einschreibeschlüssel für das Selbststudium. ',
        'study-sheet-action' => 'Studienbegleitbogen',
        'government-form-action' => 'Daten für das Statistische Landesamt',
    ],

    'contract-sent' => [
        'subject' => 'Vertrag erhalten',
        'body' => '<br> Ihr Vertrag wurde erfolgreich empfangen.',
        'paragraph1' => '<br> herzlichen Glückwunsch – Sie haben alle Schritte im Auswahlverfahren erfolgreich absolviert! 😊Wir freuen uns, Ihnen heute mitzuteilen, dass wir Ihnen gerne einen Studienplatz ab dem :desiredBeginning im Studiengang :studyCourse anbieten möchten.',
        'paragraph2' => '<br> Ihren Studienvertrag werden den nächsten Tagen in die Post geben mit der Bitte, diesen schnellstmöglich an uns zurückzusenden.',
        'paragraph3' => '<br> Wir freuen uns auf Sie!',
    ],

    'contact-us' => [
        'subject' => 'Contact ',
    ],

    'government-study-sheet' => [
        'body' => ' Hallo! ',
        'paragraph1' => ' Die Bewerbung von :name mit der Bewerbungs-ID :applicant_id ist vollständig abgeschlossen. Der/die Bewerbende kann nun immatrikuliert werden. ',
    ],

    'failed-applicant'=>[
        'subject' => 'Gescheiterter Antragsteller || NORDAKADEMIE',
        'welcome'=>'Hallo :admin',
        'body'=>'die Bewerber :name hat die Auswahltests nicht bestanden. Bitte überprüfe die Auswahltests und bestätige das Bestehen oder Nichtbestehen.',
        'action' => 'Zu den Testergebnissen',
    ],

    'greetings_1' => 'Patricia Lichtenberg',
    'greetings_2' => 'Office Hamburg',
    'greeting-message' => 'Mit besten Grüßen von der Elbe',
    'NORDAKADEMIE University of Applied Sciences' => 'NORDAKADEMIE Hochschule der Wirtschaft',
    'Kollner Chaussee 11 25337 EImshorn' => 'Kollner Chaussee 11 25337 EImshorn',
    'T: 04121 4090-154' => 'T: 04121 4090-154',
    'NORDAKADE MIE gAG University of Applied Sciences, Köllner Chaussee 11, Elmshorn, Schleswig- Holstein 25337, 04121 / 4090 - 0' => 'NORDAKADE MIE gAG University of Applied Sciences, Köllner Chaussee 11, Elmshorn, Schleswig- Holstein 25337, 04121 / 4090 - 0',
    'Get setting rings' => 'Get setting rings',
    'technical-support-message' => 'P.S.: Technische Fragen können Sie Montag - Donnerstag zwischen 8:00 Uhr und 17:00 sowie Freitag zwischen 8:00 Uhr und 14:00 Uhr unter Tel: 04121 4090-181 oder per E-Mail auswahltest@nordakademie.de klären. Falls technische Probleme auftreten, kontaktieren Sie uns bitte unverzüglich.',
];
