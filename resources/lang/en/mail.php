<?php

return [
    'welcome' => 'Hallo  :name',

    'new-user' => [
        'subject' => 'Welcome to the application portal of the Nordakademie!',
        'body1' => '<br> Thank you for your interest in a part-time Masters program at NORDAKADEMIE!',
        'body2' => '<br> In the following you will receive your NORDAKADEMIE access data, which you will need in the further course of the application.',
        'body3' => '<br> The data is valid for both our selection test and our master portal, where you can adjust your information at any time.',
        'body4' => '<br> We will inform you about the further steps of the application process separately by e-mail after receiving your <b> application documents </b>.',
        'action' => 'Login',
        'email' => '<br> E-Mail. <strong> :email </strong>',
        'password' => '<br> Password. <strong> :password </strong>',
    ],

    'new-employee' => [
        'subject' => 'Welcome to the application portal of the Nordakademie!',
        'body1' => '<br> you can use this credential for login in creadential',
        'action' => 'Login',
        'email' => '<br> E-Mail. <strong> :email </strong>',
        'password' => '<br> Password. <strong> :password </strong>',
    ],

    'reset-password' => [
        'subject' => 'Reset password',
        'body' => '<br> You are receiving this email because we have received a password reset request for your account',
        'paragraph1' => '<br> This password reset link will expire in 60 minutes.',
        'paragraph2' => '<br> If you have not requested a password reset, no further action is required.',
        'action' => 'Reset password',
    ],

    'application-approved' => [
        'subject' => 'Application approved',
        'body' => '<br> good news! <br> We have just reviewed your application and activated you for our selection tests.',
        'body2' => '<br> You can find these in the application portal under the Selection Tests tab or go there directly via this button.',
        'paragraph1' => '<br>Allow sufficient time for the selection test (approx. 2 hours) and ensure an undisturbed working environment. ',
        'paragraph2' => '<br> Our tip for you: It is best to perform the test on a PC/laptop with a mouse. ',
        'paragraph3' => '<br> After you have completed the test, we will contact you promptly with a proposed date for the selection interview with our study program director or academic staff. The interview not only serves to get to know you better, but also to give you feedback on your test results. ',
        'paragraph4' => '<br> If you have any questions in the meantime, please contact us at any time.',
        'paragraph5' => '<br> Good luck with the selection test and best regards from the river Elbe ',
        'action' => 'Go to the Selection Test',
    ],

    'new-application-approved' => [
        'paragraph1' => '<br> good news! <br> We have just reviewed and accepted your application!',
        'paragraph2' => '<br> Since you have already completed your Bachelors degree at NORDAKADEMIE, you do not have to take the selection test again, but "jump" straight to the selection interview with our program management or academic staff. ',
        'paragraph3' => '<br> Please allow us a few days to get back to you with a proposed date.',
        'paragraph4' => '<br> If you have any questions in the meantime, please contact us at any time. ',
        'paragraph5' => '<br> With best regards from the Elbe. ',
    ],

    'application-received' => [
        'subject' => 'Application received',
        'body' => '<br> Thank you for your application documents, which we hereby confirm receipt of.',
        'body2' => 'In the next step, we check your application documents. This may take a few days if necessary.',
        'body3' => 'As soon as we have accepted your application, we will activate you for our selection test and inform you about it in a separate e-mail.',
        'body4' => 'We have carefully reviewed your documents and would like to get to know you further in the next step. We have just activated our selection test for you.',
        'body5' => 'In the meantime, if you have any questions, please contact us at any time. ',
        'paragraph1' => '<br> Now you can review them and approve them for the test.',
        'action' => 'Go to Applicant detail',
    ],
    'contract-received' => [
        'subject' => 'Contract received',
        'body' => '<br> Your contract received successfully.',
        'paragraph1' => '<br> We received your signed contract today.',
        'paragraph2' => '<br> Now it is only a small step until you can start your studies. ',
        'paragraph3' => '<br> In preparation, we still need additional information from you, which you can submit to us online. There you can indicate, for example, whether you want to pay the tuition fees in installments and to which address you would like to receive your study materials.',
        'paragraph4' => '<br>Please complete the forms as soon as possible, as your enrollment can only be carried out after you have completed the accompanying study form and the data has been collected for the State Statistical Office! ',
        'paragraph5' => '<br> In good time before the start of your studies, you will receive your access data for your NORDAKADEMIE account by mail. Via this account you will receive important information, e.g. on the first attendance phase or your enrollment key for self-study.',
        'study-sheet-action' => 'Go to Study Sheet',
        'government-form-action' => 'Go to Government Form',
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
        'body' => ' Hello! ',
        'paragraph1' => ' The application of :name with the application ID :applicant_id is complete. The applicant can now be enrolled. ',
    ],

    'failed-applicant'=>[
        'subject' => 'Failed Applicant || NORDAKADEMIE',
        'welcome'=>'Hello :admin',
        'body'=>'The :name has failed the selection tests. Please review the selection tests and confirm pass or fail.',
        'action' => 'Go to test-result',
    ],

    'greetings_1' => 'Patricia Lichtenberg',
    'greetings_2' => 'Office Hamburg',
    'greeting-message' => 'With best regards from the Elbe',
    'NORDAKADEMIE University of Applied Sciences' => 'NORDAKADEMIE University of Applied Sciences',
    'Kollner Chaussee 11 25337 EImshorn' => 'Kollner Chaussee 11 25337 EImshorn',
    'T: 04121 4090-154' => 'T: 04121 4090-154',
    'NORDAKADE MIE gAG University of Applied Sciences, Köllner Chaussee 11, Elmshorn, Schleswig- Holstein 25337, 04121 / 4090 - 0' => 'NORDAKADE MIE gAG University of Applied Sciences, Köllner Chaussee 11, Elmshorn, Schleswig- Holstein 25337, 04121 / 4090 - 0',
    'Get setting rings' => 'Get setting rings',
    'technical-support-message' => 'P.S.: Technical questions can be clarified Monday - Thursday between 8:00 am and 5:00 pm and Friday between 8:00 am and 2:00 pm under Tel: 04121 4090-181 or by e-mail auswahltest@nordakademie.de. If technical problems occur, please contact us immediately.',
];
