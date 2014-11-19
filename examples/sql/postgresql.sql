--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: access_tokens; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE access_tokens (
    id integer NOT NULL,
    shop_id integer NOT NULL,
    expires_at timestamp without time zone NOT NULL,
    created_at timestamp without time zone NOT NULL,
    access_token character(50),
    refresh_token character(50)
);


ALTER TABLE public.access_tokens OWNER TO postgres;

--
-- Name: billings; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE billings (
    id integer NOT NULL,
    shop_id integer NOT NULL,
    created_at timestamp without time zone NOT NULL
);


ALTER TABLE public.billings OWNER TO postgres;

--
-- Name: billings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE billings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.billings_id_seq OWNER TO postgres;

--
-- Name: billings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE billings_id_seq OWNED BY billings.id;


--
-- Name: shops; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE shops (
    id integer NOT NULL,
    created_at timestamp without time zone NOT NULL,
    shop character(50),
    shop_url character varying(512),
    auth_code character(50)
);


ALTER TABLE public.shops OWNER TO postgres;

--
-- Name: shops_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE shops_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.shops_id_seq OWNER TO postgres;

--
-- Name: shops_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE shops_id_seq OWNED BY shops.id;


--
-- Name: subscriptions; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE subscriptions (
    id integer NOT NULL,
    shop_id integer NOT NULL,
    expires_at timestamp without time zone NOT NULL
);


ALTER TABLE public.subscriptions OWNER TO postgres;

--
-- Name: subscriptions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE subscriptions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.subscriptions_id_seq OWNER TO postgres;

--
-- Name: subscriptions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE subscriptions_id_seq OWNED BY access_tokens.id;


--
-- Name: subscriptions_id_seq1; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE subscriptions_id_seq1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.subscriptions_id_seq1 OWNER TO postgres;

--
-- Name: subscriptions_id_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE subscriptions_id_seq1 OWNED BY subscriptions.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY access_tokens ALTER COLUMN id SET DEFAULT nextval('subscriptions_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY billings ALTER COLUMN id SET DEFAULT nextval('billings_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY shops ALTER COLUMN id SET DEFAULT nextval('shops_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subscriptions ALTER COLUMN id SET DEFAULT nextval('subscriptions_id_seq1'::regclass);


--
-- Data for Name: access_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY access_tokens (id, shop_id, expires_at, created_at, access_token, refresh_token) FROM stdin;
\.


--
-- Data for Name: billings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY billings (id, shop_id, created_at) FROM stdin;
\.


--
-- Name: billings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('billings_id_seq', 1, false);


--
-- Data for Name: shops; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY shops (id, created_at, shop, shop_url, auth_code) FROM stdin;
\.


--
-- Name: shops_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('shops_id_seq', 1, false);


--
-- Data for Name: subscriptions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY subscriptions (id, shop_id, expires_at) FROM stdin;
\.


--
-- Name: subscriptions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('subscriptions_id_seq', 1, false);


--
-- Name: subscriptions_id_seq1; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('subscriptions_id_seq1', 1, false);


--
-- Name: billings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY billings
    ADD CONSTRAINT billings_pkey PRIMARY KEY (id);


--
-- Name: shops_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY shops
    ADD CONSTRAINT shops_pkey PRIMARY KEY (id);


--
-- Name: subscriptions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY access_tokens
    ADD CONSTRAINT subscriptions_pkey PRIMARY KEY (id);


--
-- Name: subscriptions_pkey1; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY subscriptions
    ADD CONSTRAINT subscriptions_pkey1 PRIMARY KEY (id);


--
-- Name: shop_id_key; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX shop_id_key ON billings USING btree (shop_id);


--
-- Name: fk1_shop_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY billings
    ADD CONSTRAINT fk1_shop_id FOREIGN KEY (shop_id) REFERENCES shops(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk1_shop_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY access_tokens
    ADD CONSTRAINT fk1_shop_id FOREIGN KEY (shop_id) REFERENCES shops(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk1_shop_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subscriptions
    ADD CONSTRAINT fk1_shop_id FOREIGN KEY (shop_id) REFERENCES shops(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

