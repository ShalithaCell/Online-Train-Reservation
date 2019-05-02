DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_USERS_FOR_ADMIN_VIEW`()
BEGIN
	select UserID, FirstName, LastName, Email, R.Description as Role, G.Description as Gender,
		case when U.isLocked = '1' then 'YES' else 'NO' end as Locked, 
        case when U.isActive = '1' then 'YES' else 'NO' end as Active
	from users as U
    inner join role as R on U.FK_RoleID = R.RoleID
    inner join gender as G on U.FK_GenderID = G.GenderID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CHECK_EMAIL_IS_EXIXTS`(in _Email nvarchar(200))
BEGIN
if exists(select * from users where Email = _Email)
then
	select '1' as result;
else
	select '0' as result;
end if;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_NEW_USER`(
in _FirstName varchar(100),
in _LastName varchar(100),
in _Role int,
in _Email varchar(200),
in _Gender int(1),
in _ContactNo varchar(20),
in _DOB date,
in _Password nvarchar(500)
)
BEGIN
	INSERT INTO users 
    (
		FK_RoleID, 
        FirstName, 
        LastName, 
        Email, 
        FK_GenderID, 
        ContactNo, 
        DOB, 
        Password, 
        LastLoginDate,
        AccountVerified,
        isLocked,
        isActive
	)
    VALUES
    (
		_Role,
        _FirstName,
        _LastName,
        _Email,
        _Gender,
        _ContactNo,
        _DOB,
        _Password,
        curdate(),
        '0',
        '0',
        '1'
    );
    
    select  'true' as result;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_ROLES`(in _RoleID int)
BEGIN
	select * from role where isActive = '1' and RoleID >= _RoleID;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_USER_BY_ID`(in _UserID int)
BEGIN
	select * from users where UserID = _UserID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CHECK_USER_LOGIN`(in _userEmail nvarchar(200),
in _password nvarchar(500)
)
BEGIN

	if exists(select * from users where Email = _userEmail and Password = _password)
    then
		if exists(select * from users where Email = _userEmail and isLocked = '0' and isActive = '1')
        then
			update users set FailedLoginAttempt = 0, LastLoginDate = curdate() where Email = _userEmail;
			select 'true' as auth,'false' as locked;
		else	
			select 'true' as auth,'true' as locked;
		end if;
	else
		update users set FailedLoginAttempt = FailedLoginAttempt+1, FailedLoginDate = curdate() where Email = _userEmail;
		select 'false' as auth,'false' as locked;
	end if;

END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_USER_BY_EMAIL`(in _email nvarchar(200))
BEGIN
	select * from users where  Email = _email limit 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPDATE_USER_BY_ADMIN`(
in _UserID int,
in _FK_RoleID int,
in _FirstName nvarchar(200),
in _LastName nvarchar(200),
in _FK_GenderID tinyint(1),
in _ContactNo varchar(20),
in _DOB date,
in _isActive tinyint(1)
)
BEGIN
	update users
    set FK_RoleID = _FK_RoleID, FirstName = _FirstName, LastName = _LastName, FK_GenderID = _FK_GenderID,
		ContactNo = _ContactNo, DOB = _DOB, isActive = _isActive
	where UserID = _UserID;
    
    select 'true' as result;
    
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VERIFICATION_ACCOUNT`(in _email nvarchar(200))
BEGIN

	if exists(select * from users where Email = _email)
    then 
    
		if exists(select * from users where Email = _email and AccountVerified = '0')
        then
			update users set AccountVerified = '1'
			where Email = _email;
            
            select 'true' as result;
		else
			select 'false' as result;
		end if;
	else
		select 'false' as result;
	end if;
    
		
        
        

END$$
DELIMITER ;
