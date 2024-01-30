--
-- PostgreSQL database dump
--

-- Dumped from database version 16.1 (Debian 16.1-1.pgdg120+1)
-- Dumped by pg_dump version 16.1

-- Started on 2024-01-30 21:20:18 UTC

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 4 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: pg_database_owner
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO pg_database_owner;

--
-- TOC entry 3386 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: pg_database_owner
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 223 (class 1259 OID 16485)
-- Name: answers; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.answers (
    id integer NOT NULL,
    question_id integer,
    answer_text text NOT NULL,
    is_correct boolean
);


ALTER TABLE public.answers OWNER TO docker;

--
-- TOC entry 222 (class 1259 OID 16484)
-- Name: answers_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.answers_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.answers_id_seq OWNER TO docker;

--
-- TOC entry 3387 (class 0 OID 0)
-- Dependencies: 222
-- Name: answers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.answers_id_seq OWNED BY public.answers.id;


--
-- TOC entry 221 (class 1259 OID 16471)
-- Name: questions; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.questions (
    id integer NOT NULL,
    quiz_id integer,
    question_text text NOT NULL
);


ALTER TABLE public.questions OWNER TO docker;

--
-- TOC entry 220 (class 1259 OID 16470)
-- Name: questions_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.questions_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.questions_id_seq OWNER TO docker;

--
-- TOC entry 3388 (class 0 OID 0)
-- Dependencies: 220
-- Name: questions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.questions_id_seq OWNED BY public.questions.id;


--
-- TOC entry 218 (class 1259 OID 16413)
-- Name: quizzes; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.quizzes (
    id integer NOT NULL,
    title character varying(100) NOT NULL,
    description character varying(255) NOT NULL,
    id_assigned_by integer NOT NULL,
    image character varying(255),
    created_at timestamp(0) without time zone
);


ALTER TABLE public.quizzes OWNER TO docker;

--
-- TOC entry 217 (class 1259 OID 16412)
-- Name: quizzes_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.quizzes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.quizzes_id_seq OWNER TO docker;

--
-- TOC entry 3389 (class 0 OID 0)
-- Dependencies: 217
-- Name: quizzes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.quizzes_id_seq OWNED BY public.quizzes.id;


--
-- TOC entry 216 (class 1259 OID 16405)
-- Name: users; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.users (
    id integer NOT NULL,
    nickname character varying(100) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    role_id integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.users OWNER TO docker;

--
-- TOC entry 215 (class 1259 OID 16404)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO docker;

--
-- TOC entry 3390 (class 0 OID 0)
-- Dependencies: 215
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 219 (class 1259 OID 16423)
-- Name: users_quizzes; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.users_quizzes (
    id_user integer NOT NULL,
    id_quiz integer NOT NULL
);


ALTER TABLE public.users_quizzes OWNER TO docker;

--
-- TOC entry 3226 (class 2604 OID 16488)
-- Name: answers id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.answers ALTER COLUMN id SET DEFAULT nextval('public.answers_id_seq'::regclass);


--
-- TOC entry 3225 (class 2604 OID 16474)
-- Name: questions id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.questions ALTER COLUMN id SET DEFAULT nextval('public.questions_id_seq'::regclass);


--
-- TOC entry 3224 (class 2604 OID 16416)
-- Name: quizzes id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.quizzes ALTER COLUMN id SET DEFAULT nextval('public.quizzes_id_seq'::regclass);


--
-- TOC entry 3222 (class 2604 OID 16408)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 3232 (class 2606 OID 16492)
-- Name: answers answers_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.answers
    ADD CONSTRAINT answers_pkey PRIMARY KEY (id);


--
-- TOC entry 3230 (class 2606 OID 16478)
-- Name: questions questions_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.questions
    ADD CONSTRAINT questions_pkey PRIMARY KEY (id);


--
-- TOC entry 3228 (class 1259 OID 16437)
-- Name: quizzes_id_uindex; Type: INDEX; Schema: public; Owner: docker
--

CREATE UNIQUE INDEX quizzes_id_uindex ON public.quizzes USING btree (id);


--
-- TOC entry 3227 (class 1259 OID 16411)
-- Name: users_id_uindex; Type: INDEX; Schema: public; Owner: docker
--

CREATE UNIQUE INDEX users_id_uindex ON public.users USING btree (id);


--
-- TOC entry 3234 (class 2606 OID 16438)
-- Name: users_quizzes _quiz_users_quizzes___fk; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users_quizzes
    ADD CONSTRAINT _quiz_users_quizzes___fk FOREIGN KEY (id_quiz) REFERENCES public.quizzes(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3235 (class 2606 OID 16431)
-- Name: users_quizzes _user_users_quizzes___fk; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users_quizzes
    ADD CONSTRAINT _user_users_quizzes___fk FOREIGN KEY (id_user) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3237 (class 2606 OID 16504)
-- Name: answers answers_question_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.answers
    ADD CONSTRAINT answers_question_id_fkey FOREIGN KEY (question_id) REFERENCES public.questions(id) ON DELETE CASCADE;


--
-- TOC entry 3236 (class 2606 OID 16499)
-- Name: questions questions_quiz_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.questions
    ADD CONSTRAINT questions_quiz_id_fkey FOREIGN KEY (quiz_id) REFERENCES public.quizzes(id) ON DELETE CASCADE;


--
-- TOC entry 3233 (class 2606 OID 16464)
-- Name: quizzes quizzes_users_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.quizzes
    ADD CONSTRAINT quizzes_users_id_fk FOREIGN KEY (id_assigned_by) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


-- Completed on 2024-01-30 21:20:18 UTC

--
-- PostgreSQL database dump complete
--

