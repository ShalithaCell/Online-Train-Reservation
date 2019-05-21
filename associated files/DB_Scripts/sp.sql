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
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_USER_BY_ID`(in _UserID int)
BEGIN
	select * from users where UserID = _UserID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_NEW_TRAIN`(in _code nvarchar(100), in _name nvarchar(100), in _description nvarchar(500))
BEGIN
	insert into train(TrainCode, TrainName, Description,IsRegularRun, isActive)
    values (_code, _name, _description, '1', '1');
    
    SELECT TrainID from train order by TrainID desc limit 1;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CHECK_RESET_TOKEN_VALIED`(in _token nvarchar(15))
BEGIN
	if exists(select * from tokenRecord where Token = _token and ExpireDate > now())
    then
		select 'true' as result;
	else
		select 'false' as result;
	end if;
        
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_FETCH_CLASSES_FOR_SEARCH`(in _from int, in _to int, in _trainID int)
BEGIN
select T.TrainCode, TC.ClassID, TC.ClassPrice * (ABS(SS.DistanceFromMainStation-S.DistanceFromMainStation)) as Price,
		TC.Description as Class
	from trainSchedule as TS
	inner join train as T on T.TrainID = TS.FK_TrainID
	inner join trainClassDetails as TCD on TCD.FK_TrainID = T.TrainID
	inner join trainClasses as TC on TC.ClassID = TCD.FK_ClassID
	inner join station as S on S.StationID = TS.FK_From 
    inner join station as SS on SS.StationID = TS.FK_To 
	where TS.FK_From = _from and TS.FK_To = _to and T.TrainID = _trainID
	order by FromTime asc;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_ACTIVE_CLASSES`()
BEGIN
	select * from trainClasses where isActive = '1';
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_ROLES`(in _RoleID int)
BEGIN
	select * from role where isActive = '1' and RoleID >= _RoleID;
    
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_STATION_BY_ID`(in _stationID int)
BEGIN
	select *
    from station
    where  StationID = _stationID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_TRAIN_DETAILS_FOR_ADMINPANEL`()
BEGIN
	select T.TrainID, T.TrainCode, T.TrainName, 
			case when T.IsRegularRun = '1' then 'YES' else 'NO' end as IsRegularRun,
            sum(D.NoOfSeats) as NoOfSeats,
            case when T.isActive = '1' then 'YES' else 'NO' end as isActive
    from train as T
    inner join trainClassDetails as D on T.TrainID = D.FK_TrainID
    group by T.TrainID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_TRAIN_SCHEDULE`(in _from int, in _to int)
BEGIN
	select T.TrainID,T.TrainCode, T.TrainName, S.Description as StationFrom, SS.Description as StationTo, TS.FromTime, TS.ToTime
	from trainSchedule as TS
	inner join train as T on T.TrainID = TS.FK_TrainID
	inner join station as S on S.StationID = TS.FK_From 
    inner join station as SS on SS.StationID = TS.FK_To 
	where TS.FK_From = _from and TS.FK_To = _to
	order by FromTime asc;
END$$
DELIMITER ;

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_USER_BY_EMAIL`(in _email nvarchar(200))
BEGIN
	select * from users where  Email = _email limit 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_USER_WITH_DETAIL`(in _userID int)
BEGIN
	select U.*, R.Description as RoleDescription, G.Description as GenderDescription
    from users as U
    inner join role as R on U.FK_RoleID = R.RoleID
    inner join gender as G on U.FK_GenderID = G.GenderID
    where U.UserID = _userID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_NEW_STATION`(in _Description nvarchar(200)
, in _DescriptionLong nvarchar(1000)
, in _Distance decimal(12,2))
BEGIN
	insert into station (Description, DescriptionLong,DistanceFromMainStation,isActive )
    values (_Description, _DescriptionLong, _Distance, '1');
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REMOVE_TRAIN`(in _trainID int)
BEGIN
	delete from ClassPrice where  FK_TrainID = _trainID;
	 delete from trainClassDetails where FK_TrainID = _trainID;
	 delete from trainSchedule where FK_TrainID = _trainID;
     delete from train where TrainID = _trainID;
     
     
     select 'true' as result;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RESET_USER_PASSWORD`(in _userID int, in _type int, in _token varchar(15))
BEGIN
	insert into tokenRecord(FK_TypeID, Token, FK_userID, sendDate, ExpireDate)
    values (_type, _token, _userID, now(),DATE_ADD(now(), INTERVAL 2 HOUR));
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RESET_USER_PASSWORD_BY_TOKEN`(in _token nvarchar(15), in _password nvarchar(100))
BEGIN
	update users set Password  = _password where  UserID = (
															select FK_userID 
															from tokenRecord 
                                                            where Token = _token);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPDATE_STATION`(in _stationID int, in _station nvarchar(50), in _Description nvarchar(1000), in _Distance decimal(12,2))
BEGIN
	update station set Description = _station,
						DescriptionLong = _Description,
                        DistanceFromMainStation = _Distance
			where StationID = _stationID;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPDATE_TRAIN`(in _trainID int, 
in _code nvarchar(100), 
in _name nvarchar(500), 
in _description nvarchar(500))
BEGIN
 update train set TrainCode = _code, TrainName = _name, Description = _description 
 where TrainID = _trainID;
 
 delete from ClassPrice where  FK_TrainID = _trainID;
 delete from trainClassDetails where FK_TrainID = _trainID;
 delete from trainSchedule where FK_TrainID = _trainID;
 
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
