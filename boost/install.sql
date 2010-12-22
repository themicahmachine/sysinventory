-- Set up tables for Sysinventory:
-- @author Micah Carter <mcarter at tux dot appstate dot edu>
BEGIN;
CREATE TABLE sysinventory_admin (
    id int NOT NULL DEFAULT 0,
    username varchar(255) NOT NULL,
    department_id int NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE sysinventory_location (
    id int NOT NULL,
    description varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE sysinventory_department (
    id int NOT NULL,
    description varchar(255) NOT NULL,
    last_update int NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE sysinventory_system (
    id int NOT NULL,
    location_id int,
    department_id int NOT NULL,
    room_number varchar(255),
    model varchar(255),
    hdd varchar(255),
    proc varchar(255),
    ram varchar(255),
    dual_mon varchar(255) default 'no',
    mac varchar(255),
    printer varchar(255) default NULL,
    staff_member varchar(255),
    username varchar(255),
    telephone varchar(255),
    docking_stand varchar(255) default 'no',
    deep_freeze varchar(255) default 'no',
    purchase_date date,
    vlan varchar(255),
    reformat varchar(255) default 'no',
    notes varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE sysinventory_default_system (
    id int NOT NULL,
    name varchar(255) NOT NULL,
    model varchar(255),
    hdd varchar(255),
    proc varchar(255),
    ram varchar(255),
    dual_mon varchar(255) default 'no',
    PRIMARY KEY (id)
);

ALTER TABLE sysinventory_system ADD FOREIGN KEY (department_id) REFERENCES sysinventory_department(id);
ALTER TABLE sysinventory_system ADD FOREIGN KEY (location_id) REFERENCES sysinventory_location(id);
ALTER TABLE sysinventory_admin ADD FOREIGN KEY (department_id) REFERENCES sysinventory_department(id);
COMMIT;
