create database groep35 collate SQL_Latin1_General_CP1_CI_AS
go

create table TBL_Feedback_Type
(
  feedback_type char(8) not null
    constraint TBL_Feedback_Type_pk
    primary key nonclustered
)
go

create table TBL_Item
(
  item                  bigint identity
    constraint TBL_Item_pk
    primary key nonclustered,
  name                  varchar(100)            not null,
  description           varchar(1000)           not null,
  price_start           numeric(9, 2)           not null,
  shipping_cost         numeric(9, 2) default 0 not null,
  shipping_instructions varchar(250),
  address_line_1        varchar(100)            not null,
  address_line_2        varchar(100)
)
go

create table TBL_Media_Type
(
  media_type varchar(32) not null
    constraint TBL_Media_Type_pk
    primary key nonclustered
)
go

create table TBL_Resource
(
  item        bigint         not null
    constraint TBL_Resource_TBL_Item_item_fk
    references TBL_Item,
  [file]      varbinary(max) not null,
  media_type  varchar(32)    not null
    constraint TBL_Resource_TBL_Media_Type_media_type_fk
    references TBL_Media_Type,
  sort_number int            not null,
  constraint TBL_Resource_pk
  primary key nonclustered (item, sort_number)
)
go

create table TBL_Rubric
(
  rubric      int identity
    constraint TBL_Rubric_pk
    primary key nonclustered,
  name        varchar(32) not null,
  super       int
    constraint TBL_Rubric_TBL_Rubric_rubric_fk
    references TBL_Rubric,
  sort_number int
)
go

create table TBL_Item_In_Rubric
(
  item   bigint not null
    constraint TBL_Item_In_Rubric_TBL_Item_item_fk
    references TBL_Item,
  rubric int    not null
    constraint TBL_Item_In_Rubric_TBL_Rubric_rubric_fk
    references TBL_Rubric,
  constraint TBL_Item_In_Rubric_pk
  primary key nonclustered (item, rubric)
)
go

create table TBL_User
(
  [user]            varchar(32)   not null
    constraint TBL_User_pk
    primary key nonclustered,
  firstname         varchar(200)  not null,
  lastname          varchar(200)  not null,
  address_line_1    varchar(100)  not null,
  address_line_2    varchar(100),
  email             varchar(255)  not null,
  password          varchar(40)   not null,
  is_seller         bit default 0 not null,
  is_verified       bit default 0 not null,
  verification_code varchar(10)
)
go

create table TBL_Auction
(
  auction        int identity
    constraint TBL_Auction_pk
    primary key nonclustered,
  seller         varchar(32)
    constraint TBL_Auction_TBL_User_user_fk
    references TBL_User,
  auction_closed bit      default 0         not null,
  moment_start   datetime default getdate() not null,
  moment_end     datetime,
  item           bigint                     not null
    constraint TBL_Auction_TBL_Item_item_fk
    references TBL_Item,
  is_promoted    bit                        not null
)
go

create table TBL_Bid
(
  auction int                        not null
    constraint TBL_Bid_TBL_Auction_auction_number_fk
    references TBL_Auction,
  amount  numeric(9, 2)              not null,
  [user]  varchar(32)
    constraint TBL_Bid_TBL_User_user_fk
    references TBL_User,
  moment  datetime default getdate() not null,
  constraint TBL_Bid_pk
  primary key nonclustered (auction, amount)
)
go

create table TBL_Feedback
(
  auction       int         not null
    constraint TBL_Feedback_TBL_Auction_auction_fk
    references TBL_Auction,
  feedback_type char(8)     not null
    constraint TBL_Feedback_TBL_Feedback_Type_feedback_type_fk
    references TBL_Feedback_Type,
  moment        datetime,
  comment       varchar(100),
  giver         varchar(32) not null
    constraint TBL_Feedback_TBL_User_user_fk
    references TBL_User,
  receiver      varchar(32) not null
    constraint TBL_Feedback_TBL_User_user_fk_2
    references TBL_User,
  constraint TBL_Feedback_pk
  primary key nonclustered (auction, giver)
)
go

create table TBL_Phone
(
  [user]       varchar(32) not null
    constraint TBL_Phone_TBL_User_user_fk
    references TBL_User,
  phone_number varchar(20) not null,
  is_mobile    bit         not null,
  constraint TBL_Phone_pk
  primary key nonclustered ([user], phone_number)
)
go

create table TBL_Seller
(
  [user]              varchar(32) not null
    constraint TBL_Seller_pk
    primary key nonclustered
    constraint TBL_Seller_TBL_User_user_fk
    references TBL_User,
  bank_account        char(18),
  verification_status bit         not null
)
go

create unique index TBL_User_verification_code_uindex
  on TBL_User (verification_code)
go

create unique index TBL_User_email_uindex
  on TBL_User (email)
go

