BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "vehicle_master_data" (
	"vm_id"	INTEGER,
	"v_type"	TEXT,
	"cost_km"	INTEGER,
	"fuel_type"	TEXT,
	"driver_pay"	INTEGER,
	"delStatus"	TEXT,
	PRIMARY KEY("vm_id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "vehicles" (
	"v_id"	INTEGER,
	"v_number"	TEXT,
	"v_model"	TEXT,
	"v_brand"	TEXT,
	"delStatus"	TEXT,
	"vm_id"	INTEGER,
	PRIMARY KEY("v_id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "available_vehicles" (
	"av_id"	INTEGER,
	"v_id"	INTEGER,
	"location"	INTEGER,
	"status"	TEXT,
	PRIMARY KEY("av_id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "user_location" (
	"ul_id"	INTEGER,
	"user_id"	INTEGER,
	"long"	TEXT,
	"latt"	TEXT,
	PRIMARY KEY("ul_id" AUTOINCREMENT),
	FOREIGN KEY("user_id") REFERENCES "user_details"("uid")
);
CREATE TABLE IF NOT EXISTS "vehicle_location" (
	"vl_id"	INTEGER,
	"v_id"	INTEGER,
	"long"	TEXT,
	"latt"	TEXT,
	PRIMARY KEY("vl_id" AUTOINCREMENT),
	FOREIGN KEY("v_id") REFERENCES "vehicles"("v_id")
);
CREATE TABLE IF NOT EXISTS "passenger_req" (
	"ps_id"	INTEGER,
	"u_id"	INTEGER,
	"pick_location"	INTEGER,
	"drop_location"	INTEGER,
	"req_time"	TEXT,
	"req_stat"	TEXT,
	PRIMARY KEY("ps_id" AUTOINCREMENT),
	FOREIGN KEY("pick_location") REFERENCES "user_location"("ul_id")
);
CREATE TABLE IF NOT EXISTS "trip_details" (
	"trip_id"	INTEGER,
	"req_id"	INTEGER,
	"cust_id"	INTEGER,
	"driver_id"	INTEGER,
	"dist_km"	INTEGER,
	"conf_time"	TEXT,
	"pick_time"	TEXT,
	"drop_time"	TEXT,
	"drop_location"	INTEGER,
	"total_cost"	INTEGER,
	"driver_pay"	INTEGER,
	PRIMARY KEY("trip_id" AUTOINCREMENT),
	FOREIGN KEY("req_id") REFERENCES "passenger_req"("ps_id"),
	FOREIGN KEY("cust_id") REFERENCES "user_details"("uid"),
	FOREIGN KEY("driver_id") REFERENCES "user_details"("uid")
);
CREATE TABLE IF NOT EXISTS "payment_details" (
	"pay_id"	INTEGER,
	"trip_id"	INTEGER,
	"card_no"	TEXT,
	"total_value"	INTEGER,
	"payment_date"	TEXT,
	PRIMARY KEY("pay_id" AUTOINCREMENT),
	FOREIGN KEY("trip_id") REFERENCES "trip_details"("trip_id")
);
CREATE TABLE IF NOT EXISTS "user_details" (
	"uid"	INTEGER,
	"name1"	TEXT,
	"name2"	TEXT,
	"address"	TEXT,
	"userName"	TEXT,
	"contact"	TEXT,
	"email"	TEXT,
	"userType"	TEXT,
	"password"	TEXT,
	"delStatus"	TEXT,
	"verify"	TEXT,
	PRIMARY KEY("uid" AUTOINCREMENT)
);
COMMIT;
