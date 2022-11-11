### Applicant Synced To Hubsport

- Add private app's access token to .env
- Run `CreateHubspotPropertiesForApplicantJob` job for create properties to applicant
- Add following identifier to `application_statuses` DB table
    - Application incomplete = `application_incomplete`
    - Application submitted = `application_submitted`
    - Application accepted = `application_accepted`
    - Test taken = `test_completed`
    - Selection interview on = `selection_interview_on`
    - Contract sent on = `contract_sent_on`
    - Contract returned on = `contract_returned_on`
    - Rejection by NAK = `rejected_by_nak`
    - Rejection by applicant = `rejected_by_applicant`
- Run `SyncApplicantsToHubspotJob` job for create applicants to hubspot
- If you want to sync single applicant to hubspot then run `CreateOrUpdateApplicantDataToHubspotJob` job
