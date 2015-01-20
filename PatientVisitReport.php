SELECT Doctor.First_name, Doctor.Last_name, COUNT(Visit.Date_of_visit) FROM Doctor LEFT JOIN Visit on Doctor.License_number=Visit.License_number GROUP BY Doctor.License_number

SELECT Doctor.First_name, Doctor.Last_name, COUNT(Visit.Date_of_visit), COUNT(Prescription.Date_of_visit) FROM Doctor LEFT JOIN Visit on Doctor.License_number=Visit.License_number LEFT JOIN Prescription on Doctor.License_number=Prescription.License_number GROUP BY Doctor.License_number



SELECT Doctor.First_name, Doctor.Last_name, COUNT(Visit.Date_of_visit), SUM(Visit.Billing_amount) FROM Doctor LEFT JOIN Visit on Doctor.License_number=Visit.License_number GROUP BY Doctor.License_number

COUNT(Prescription.Date_of_visit)
LEFT JOIN Prescription ON Doctor.License_number=Prescription.License_number



SELECT Doctor.First_name, Doctor.Last_name, COUNT(Visit.Date_of_visit), SUM(Visit.Billing_amount) FROM Doctor LEFT JOIN Visit on Doctor.License_number=Visit.License_number GROUP BY Doctor.License_number;


SELECT DISTINCT Doctor.License_number, COUNT(Prescription.Date_of_visit) FROM Doctor
LEFT JOIN Prescription ON Doctor.License_number=Prescription.License_number GROUP BY Doctor.License_number, ;

SELECT Doctor.First_name, Doctor.Last_name, COUNT(Visit.Date_of_visit), COUNT(Prescription.Medicine_name), SUM(Visit.Billing_amount) FROM Doctor LEFT JOIN Visit on Doctor.License_number=Visit.License_number LEFT JOIN Prescription ON Doctor.License_number=Prescription.License_number GROUP BY Doctor.License_number;




SELECT Doctor.First_name, Doctor.Last_name, COUNT(Visit.Date_of_visit), SUM(Visit.Billing_amount) FROM Doctor LEFT JOIN Visit on Doctor.License_number=Visit.License_number GROUP BY Doctor.License_number;

