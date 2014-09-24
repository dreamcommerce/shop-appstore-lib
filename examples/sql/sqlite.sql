PRAGMA synchronous = OFF;
PRAGMA journal_mode = MEMORY;
BEGIN TRANSACTION;
CREATE TABLE "access_tokens" (
  "id" int(10)  NOT NULL ,
  "shop_id" int(10)  DEFAULT NULL,
  "expires_at" timestamp NULL DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  "access_token" char(50) DEFAULT NULL,
  "refresh_token" char(50) DEFAULT NULL,
  PRIMARY KEY ("id")
);
CREATE TABLE "billings" (
  "id" int(10)  NOT NULL,
  "shop_id" int(10)  DEFAULT NULL,
  "created_at" timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ("id")
);
CREATE TABLE "shops" (
  "id" int(11)  NOT NULL ,
  "created_at" timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  "shop" char(50) DEFAULT NULL,
  "shop_url" varchar(512) DEFAULT NULL,
  "auth_code" char(50) DEFAULT NULL,
  PRIMARY KEY ("id")
);
CREATE TABLE "subscriptions" (
  "id" int(10)  NOT NULL ,
  "shop_id" int(10)  NOT NULL,
  "expires_at" timestamp NULL DEFAULT NULL,
  PRIMARY KEY ("id")
);
CREATE INDEX "subscriptions_shop_id" ON "subscriptions" ("shop_id");
CREATE INDEX "shops_shop" ON "shops" ("shop");
CREATE INDEX "access_tokens_shop_id" ON "access_tokens" ("shop_id");
CREATE INDEX "billings_shop_id" ON "billings" ("shop_id");
END TRANSACTION;
