
use authentication;

DECLARE @app_id INT;
SET @app_id = 0; -- Should match your application id

--DELETE FROM permissions WHERE application_id=@app_id

/*

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblBulletinAcceptance details', 'add_tblBulletinAcceptance', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblBulletinAcceptances', 'tblBulletinAcceptances', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblBulletinAcceptances', 'add_tblBulletinAcceptance', 'add_tblBulletinAcceptance_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblBulletinAcceptances', '', 'delete_tblBulletinAcceptance_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblBulletinAssignment details', 'add_tblBulletinAssignment', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblBulletinAssignments', 'tblBulletinAssignments', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblBulletinAssignments', 'add_tblBulletinAssignment', 'add_tblBulletinAssignment_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblBulletinAssignments', '', 'delete_tblBulletinAssignment_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblBulletin details', 'add_tblBulletin', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblBulletins', 'tblBulletins', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblBulletins', 'add_tblBulletin', 'add_tblBulletin_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblBulletins', '', 'delete_tblBulletin_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblComputer details', 'add_tblComputer', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblComputers', 'tblComputers', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblComputers', 'add_tblComputer', 'add_tblComputer_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblComputers', '', 'delete_tblComputer_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblConnection details', 'add_tblConnection', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblConnections', 'tblConnections', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblConnections', 'add_tblConnection', 'add_tblConnection_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblConnections', '', 'delete_tblConnection_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblDepartment details', 'add_tblDepartment', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblDepartments', 'tblDepartments', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblDepartments', 'add_tblDepartment', 'add_tblDepartment_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblDepartments', '', 'delete_tblDepartment_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblEmployee details', 'add_tblEmployee', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblEmployee', 'tblEmployee', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblEmployee', 'add_tblEmployee', 'add_tblEmployee_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblEmployee', '', 'delete_tblEmployee_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblEmploymentType details', 'add_tblEmploymentType', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblEmploymentTypes', 'tblEmploymentTypes', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblEmploymentTypes', 'add_tblEmploymentType', 'add_tblEmploymentType_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblEmploymentTypes', '', 'delete_tblEmploymentType_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblExportFormat details', 'add_tblExportFormat', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblExportFormats', 'tblExportFormats', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblExportFormats', 'add_tblExportFormat', 'add_tblExportFormat_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblExportFormats', '', 'delete_tblExportFormat_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblHoliday details', 'add_tblHoliday', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblHolidaies', 'tblHolidaies', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblHolidaies', 'add_tblHoliday', 'add_tblHoliday_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblHolidaies', '', 'delete_tblHoliday_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblJob details', 'add_tblJob', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblJobs', 'tblJobs', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblJobs', 'add_tblJob', 'add_tblJob_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblJobs', '', 'delete_tblJob_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblSetting details', 'add_tblSetting', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblSettings', 'tblSettings', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblSettings', 'add_tblSetting', 'add_tblSetting_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblSettings', '', 'delete_tblSetting_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblShift details', 'add_tblShift', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblShifts', 'tblShifts', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblShifts', 'add_tblShift', 'add_tblShift_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblShifts', '', 'delete_tblShift_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblTimeLogging details', 'add_tblTimeLogging', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblTimeLoggings', 'tblTimeLoggings', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblTimeLoggings', 'add_tblTimeLogging', 'add_tblTimeLogging_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblTimeLoggings', '', 'delete_tblTimeLogging_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblTimeNote details', 'add_tblTimeNote', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblTimeNotes', 'tblTimeNotes', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblTimeNotes', 'add_tblTimeNote', 'add_tblTimeNote_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblTimeNotes', '', 'delete_tblTimeNote_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblTime details', 'add_tblTime', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblTimes', 'tblTimes', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblTimes', 'add_tblTime', 'add_tblTime_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblTimes', '', 'delete_tblTime_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblTipPayment details', 'add_tblTipPayment', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblTipPayments', 'tblTipPayments', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblTipPayments', 'add_tblTipPayment', 'add_tblTipPayment_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblTipPayments', '', 'delete_tblTipPayment_model');

INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'View TblTip details', 'add_tblTip', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'List TblTips', 'tblTips', '');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Add/Update TblTips', 'add_tblTip', 'add_tblTip_model');
INSERT INTO permissions (application_id, permission_name, view_name, model_name) VALUES (@app_id, 'Delete TblTips', '', 'delete_tblTip_model');

*/

-- automatically add these permissions to the Super Administrators group
declare @sup_admin int;
set @sup_admin = (select top 1 group_id from groups where group_name like '%super administrator%')
print @sup_admin

--insert into group_permissions (permission_id, group_id) 
select permission_id, @sup_admin
from permissions
where application_id=@app_id
	and permission_id NOT IN (select permission_id from group_permissions where application_id=@app_id)
