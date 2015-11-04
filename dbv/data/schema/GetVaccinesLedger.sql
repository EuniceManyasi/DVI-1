CREATE DEFINER=`root`@`localhost` PROCEDURE `GetVaccinesLedger`(IN $selected_vaccine VARCHAR(255))
BEGIN
SELECT mv.Vaccine_name, ms.physical_count,ms.quantity_in,ms.quantity_out,msb.stock_balance, ms.batch_number,ms.expiry_date,mvvm.name FROM m_stock_movement ms
LEFT JOIN m_vaccines mv ON mv.ID=ms.vaccine_id
LEFT JOIN m_stock_balance msb ON msb.vaccine_id=ms.vaccine_id
LEFT JOIN m_vvm_status mvvm ON mvvm.id=ms.VVM_status
WHERE ms.vaccine_id= $selected_vaccine;
END