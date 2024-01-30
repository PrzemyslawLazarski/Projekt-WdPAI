--
-- PostgreSQL database dump
--

-- Dumped from database version 16.1 (Debian 16.1-1.pgdg120+1)
-- Dumped by pg_dump version 16.1

-- Started on 2024-01-30 21:19:40 UTC

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
-- TOC entry 3377 (class 0 OID 16405)
-- Dependencies: 216
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.users (id, nickname, email, password, role_id) FROM stdin;
16	adam	adam@adam.pl	$2y$10$EOR/no0zFmN3gUXesHkiKesBp0FEHTtN73lm0sP.5Cu4mwVWxHbDC	0
17	admin	admin@admin.pl	$2y$10$1RUDeqD9NGa0nenhqMGiJOhEPVlazR3lnrPvmuUzTWZvORMsCvWh.	1
18	maciek123	maciek@maciek.pl	$2y$10$9DZRa51oj/aPdR1Zsa9rKuIO4sf8ArrJL1uZHuQjliP2VQkPUp9My	0
19	SuperTomek123	tomek@tomek.pl	$2y$10$EDYsN5zHV6aBv7rFsZF0fODFdkz6xN9Z0lxa3T/ltbOArjWtvcHPG	0
20	NiszczycielJanek2001	janek@janek.pl	$2y$10$v2NVRH7HxYlpecFkJcXp6ujUuh2IumOeHG3A/vGoFfNKrVMZapPmm	0
21	KoxPrzemek2000	przemek@przemek.pl	$2y$10$IhVhy/koVdIiB/5nK/acDuDinkX7YxgYnu4pMCM3KL3fkjjSj2sX6	0
22	user123	user@user.pl	$2y$10$bhk6/N0gBp/E/vmV.QGU0.aApxm/dLDKSyCVaPzxCxD45ErirxFYe	0
\.


--
-- TOC entry 3379 (class 0 OID 16413)
-- Dependencies: 218
-- Data for Name: quizzes; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.quizzes (id, title, description, id_assigned_by, image, created_at) FROM stdin;
155	Stolice	Quiz o stolicach największych państw świata!	19	city.jpg	2024-01-30 00:00:00
157	Państwa Europy	Quiz o państwach Europy	19	countries.jpg	2024-01-30 00:00:00
158	Skoki narciarskie	Quiz o skokach narciarskich	17	ski.jpg	2024-01-30 00:00:00
159	Historia	Quiz o Historii XV wieku	17	history.jpg	2024-01-30 00:00:00
161	Sport	Quiz o różnych dyscyplinach sportowych	20	sport.jpg	2024-01-30 00:00:00
162	Literatura	Sprawdź jak dobrze znasz polską literaturę	20	books.jpg	2024-01-30 00:00:00
163	Muzyka	Sprawdź jak dobrze znasz utwory największych twórców!	20	music.jpg	2024-01-30 00:00:00
164	Kulinaria	Sprawdź swoją wiedzę o kuchni świata!	21	food.jpg	2024-01-30 00:00:00
167	Gry i Rozrywka	Wskocz do świata gier i rozrywki!	21	game.jpg	2024-01-30 00:00:00
168	Harry Potter	Wkrocz do krainy magii razem z Harrym Potterem!	21	harry.jpg	2024-01-29 00:00:00
160	Filmy	Quiz o filmach z Netflixa i nie tylko!	20	movie.jpg	2024-01-01 00:00:00
\.


--
-- TOC entry 3382 (class 0 OID 16471)
-- Dependencies: 221
-- Data for Name: questions; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.questions (id, quiz_id, question_text) FROM stdin;
115	157	Jakie państwo w Europie ma najwięcej ludności?
116	157	Jakie państwo w Europie jest najmniejsze?
117	157	Jakie państwo w Europie jest najbogatsze?
118	158	Kto jest uważany za wynalazcę nowoczesnej techniki skoków narciarskich, znanej jako "styl V"?
119	158	W którym roku skoki narciarskie zostały po raz pierwszy włączone do programu Zimowych Igrzysk Olimpijskich?
120	158	Kto zdobył tytuł Mistrza Świata w skokach narciarskich w 2021 roku?
121	158	Jaki jest oficjalny rekord świata w długości skoku narciarskiego (stan na 2023 rok)?
122	158	Kto jest najbardziej utytułowanym polskim skoczkiem narciarskim?
123	158	Gdzie znajduje się słynna skocznia "Holmenkollbakken"?
124	158	Jaki kraj jest znany z dominacji w skokach narciarskich w latach 90.?
125	159	W którym roku rozpoczęła się I Wojna Światowa?
126	159	Kto napisał "Deklarację Niepodległości Stanów Zjednoczonych"?
127	159	Jaki był zawód Juliusza Cezara?
128	160	Kto wyreżyserował film "Titanic"?
129	160	Jak nazywa się pierwszy film z serii Harry Potter?
130	160	Kto gra główną rolę w serialu "Breaking Bad"?
131	161	W którym sporcie znany jest Michael Jordan?
132	161	 W którym roku odbyły się pierwsze nowożytne Igrzyska Olimpijskie?
133	161	Który kraj wygrał Mistrzostwa Świata w Piłce Nożnej w 2014 roku?
134	162	Kto napisał "Romeo i Julię"?
135	162	Jakie jest pełne nazwisko Sherlocka Holmesa?
136	162	Kto jest autorem powieści "W 80 dni dookoła świata"?
137	163	Kto jest autorem hitu "Thriller"?
138	163	Który zespół nagrał album "The Dark Side of the Moon"?
139	163	W której dekadzie zadebiutowała Madonna?
140	164	Co jest głównym składnikiem Guacamole?
141	164	Z którego kraju pochodzi sushi?
142	164	Jaka jest tradycyjna podstawa risotto?
107	155	Jakie miasto jest stolicą Polski?
108	155	Jakie miasto jest stolicą Francji?
109	155	Jakie miasto jest stolicą Włoch?
110	155	Jakie miasto jest stolicą Hiszpani?
145	167	W jakiej grze występuje postać o imieniu Mario?
146	167	Która konsola do gier została wydana przez Sony?
147	167	Jak nazywa się główny antagonist w grze "The Legend of Zelda"?
148	168	Jakie jest pełne imię i nazwisko Harry'ego Pottera?
149	168	Która z tych postaci NIE była członkiem Zakonu Feniksa?
150	168	Jaki przedmiot znalazł Harry w Komnacie Tajemnic?
\.


--
-- TOC entry 3384 (class 0 OID 16485)
-- Dependencies: 223
-- Data for Name: answers; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.answers (id, question_id, answer_text, is_correct) FROM stdin;
307	107	Kraków	f
308	107	Warszawa	t
309	107	Poznań	f
310	107	Wrocław	f
311	108	Paryż	t
312	108	Marsylia	f
313	108	Lyon	f
314	108	Nicea 	f
315	109	Wenecja	f
316	109	Mediolan	f
317	109	Florencja	f
318	109	Rzym	t
319	110	Barcelona	f
320	110	Madryt	t
321	110	Sewilla	f
322	110	Walencja	f
339	115	Niemcy	f
340	115	Francja	f
341	115	Rosja	t
342	115	Polska	f
343	116	Watykan	t
344	116	Czechy	f
345	116	Słowacja	f
346	116	Polska	f
347	117	Wielka Brytania	f
348	117	Hiszpania	f
349	117	Włochy	f
350	117	Liechtenstein	t
351	118	Matti Nykänen	t
352	118	Janne Ahonen	f
353	118	Jens Weissflog	f
354	118	Adam Małysz	f
355	119	1924	t
356	119	1936	f
357	119	1948	f
358	119	1964	f
359	120	Kamil Stoch	f
360	120	Ryoyu Kobayashi	f
361	120	Stefan Kraft	f
362	120	Piotr Żyła	t
363	121	253,5 metra	t
364	121	246,5 metra	f
365	121	239 metrów	f
366	121	252 metry	f
367	122	Adam Małysz	f
368	122	Kamil Stoch	f
369	122	Piotr Żyła	f
370	122	Przemysław Łazarski	t
371	123	W Austrii	f
372	123	W Norwegii	t
373	123	W Szwajcarii	f
374	123	W Niemczech	f
375	124	Finlandia	t
376	124	Norwegia	f
377	124	Austria	f
378	124	Niemcy	f
379	125	1914	t
380	125	1918	f
381	125	1939	f
382	125	1945	f
383	126	George Washington	f
384	126	Thomas Jefferson	t
385	126	Abraham Lincoln	f
386	126	Benjamin Franklin	f
387	127	Filozof	f
388	127	Król	f
389	127	Generał i polityk	t
390	127	Artysta	f
391	128	Steven Spielberg	f
392	128	James Cameron	t
393	128	Martin Scorsese	f
394	128	Quentin Tarantino	f
395	129	Harry Potter i Komnata Tajemnic	f
396	129	Harry Potter i Zakon Feniksa	f
397	129	Harry Potter i Kamień Filozoficzny	t
398	129	Harry Potter i Więzień Azkabanu	f
399	130	Jon Hamm	f
400	130	Bryan Cranston	t
401	130	Aaron Paul	f
402	130	Kevin Spacey	f
403	131	Baseball	f
404	131	Piłka nożna	f
405	131	Koszykówka	t
406	131	Tenis	f
407	132	1896	t
408	132	1900	f
409	132	1912	f
410	132	1924	f
411	133	Brazylia	f
412	133	Niemcy	t
413	133	Argentyna	f
414	133	Hiszpania	f
415	134	William Shakespeare	t
416	134	Charles Dickens	f
417	134	Jane Austen	f
418	134	F. Scott Fitzgerald	f
419	135	Sherlock James Holmes	f
420	135	Sherlock Scott Holmes	f
421	135	Sherlock John Holmes	f
422	135	Sherlock Holmes nie ma środkowego imienia	t
423	136	Jules Verne	t
424	136	H.G. Wells	f
425	136	Mark Twain	f
426	136	Leo Tolstoy	f
427	137	Michael Jackson	t
428	137	Prince	f
429	137	Madonna	f
430	137	David Bowie	f
431	138	The Beatles	f
432	138	Pink Floyd	t
433	138	Led Zeppelin	f
434	138	The Rolling Stones	f
435	139	Lata 60.	f
436	139	Lata 70.	f
437	139	Lata 80.	t
438	139	Lata 90.	f
439	140	Pomidory	f
440	140	Awokado	t
441	140	Cebula	f
442	140	Papryka chili	f
443	141	Chiny	f
444	141	Japonia	t
445	141	Korea	f
446	141	Tajlandia	f
447	142	Makaron	f
448	142	Quinoa	f
449	142	Ryż	t
450	142	Kasza	f
459	145	Sonic the Hedgehog	f
460	145	Super Mario Bros	t
461	145	The Legend of Zelda	f
462	145	Mega Man	f
463	146	Xbox	f
464	146	Nintendo Switch	f
465	146	PlayStation	t
466	146	Sega Genesis	f
467	147	Ganondorf	t
468	147	Bowser	f
469	147	Sephiroth	f
470	147	Dr. Robotnik	f
471	148	Harry James Potter	t
472	148	Harry Sirius Potter	f
473	148	Harry Severus Potter	f
474	148	Harry Albus Potter	f
475	149	Severus Snape	f
476	149	Dolores Umbridge	t
477	149	Sirius Black	f
478	149	Remus Lupin	f
479	150	Diadem Roweny z Ravenclaw	f
480	150	Medalion Salazara Slytherina	f
481	150	Puchar Helgi z Hufflepuff	f
482	150	Dziennik Toma Riddle'a	t
\.


--
-- TOC entry 3380 (class 0 OID 16423)
-- Dependencies: 219
-- Data for Name: users_quizzes; Type: TABLE DATA; Schema: public; Owner: docker
--

COPY public.users_quizzes (id_user, id_quiz) FROM stdin;
\.


--
-- TOC entry 3390 (class 0 OID 0)
-- Dependencies: 222
-- Name: answers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.answers_id_seq', 694, true);


--
-- TOC entry 3391 (class 0 OID 0)
-- Dependencies: 220
-- Name: questions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.questions_id_seq', 203, true);


--
-- TOC entry 3392 (class 0 OID 0)
-- Dependencies: 217
-- Name: quizzes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.quizzes_id_seq', 219, true);


--
-- TOC entry 3393 (class 0 OID 0)
-- Dependencies: 215
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.users_id_seq', 22, true);


-- Completed on 2024-01-30 21:19:46 UTC

--
-- PostgreSQL database dump complete
--

