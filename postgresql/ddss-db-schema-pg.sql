-- 
-- =========================================
-- Design and Development of Secure Software
-- ============= MSI 2025/2026 =============
-- ======== Practical Assignment #2 ========
-- =========================================
--
-- Department of Informatics Engineering
-- University of Coimbra
--
-- Author:
--   Agostinho Jose Ujembe <uc2025135102@student.uc.pt>
--
-- This script initializes the PostgreSQL database schema
-- and default data for Assignment #2.
--

-- -----------------------------------------
-- Drop tables (only for development/testing)
-- -----------------------------------------
DROP TABLE IF EXISTS messages;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS books;

-- -----------------------------------------
-- Users table (Part 1 - Authentication)
-- Passwords are stored using password_hash()
-- (salt is internally managed by PHP)
-- -----------------------------------------
CREATE TABLE users (
    username    VARCHAR(32) PRIMARY KEY,
    password    VARCHAR(255) NOT NULL
);

-- -----------------------------------------
-- Messages table (Part 2 - Text submission)
-- author: Vulnerable | Correct
-- message: user-submitted content
-- -----------------------------------------
CREATE TABLE messages (
    message_id  SERIAL PRIMARY KEY,
    author      VARCHAR(16),
    message     VARCHAR(256) NOT NULL
);

-- -----------------------------------------
-- Books table (used in later parts)
-- -----------------------------------------
CREATE TABLE books (
    book_id         SERIAL PRIMARY KEY,
    title           VARCHAR(128),
    authors         VARCHAR(256),
    category        VARCHAR(128),
    price           NUMERIC(8,2),
    book_date       DATE,
    description     VARCHAR(1024),
    keywords        VARCHAR(256),
    notes           VARCHAR(256),
    recomendation   INTEGER
);

-- -----------------------------------------
-- Default data for messages (Part 2)
-- -----------------------------------------
INSERT INTO messages (author, message)
VALUES ('Vulnerable', 'Hi! I wrote this message using Vulnerable Form.');

INSERT INTO messages (author, message)
VALUES ('Correct', 'OMG! This form is so correct!!!');

INSERT INTO messages (author, message)
VALUES ('Vulnerable', 'Oh really?');

-- -----------------------------------------
-- Default user for authentication (Part 1)
-- username: test
-- password: test123
-- Generated with password_hash()
-- -----------------------------------------
INSERT INTO users (username, password)
VALUES (
    'test',
    '$2y$10$eImiTXuWVxfM37uY4JANjQ'
);

-- -----------------------------------------
-- Default data for books
-- -----------------------------------------
INSERT INTO books (title, authors, category, price, book_date, keywords, notes, recomendation, description)
VALUES (
    'Web Database Development : Step by Step',
    'Jim Buyens',
    'Databases',
    39.99,
    '2007-01-01',
    'Web; persistence; sql',
    'This is a very nice book.',
    10,
    'As Web sites continue to grow in complexity and in the volume of data they must present, databases increasingly drive their content.'
);

INSERT INTO books (title, authors, category, price, book_date, keywords, notes, recomendation, description)
VALUES (
    'Programming Perl (3rd Edition)',
    'Larry Wall, Tom Christiansen, Jon Orwant',
    'Programming',
    39.96,
    '2009-12-01',
    'Perl; scripts; code',
    'This is a very nice book.',
    9,
    'Programming Perl is the definitive guide to the Perl language and its culture.'
);

INSERT INTO books (title, authors, category, price, book_date, keywords, notes, recomendation, description)
VALUES (
    'Perl and CGI for the World Wide Web: Visual QuickStart Guide',
    'Elizabeth Castro',
    'Programming',
    15.19,
    '2009-06-01',
    'Perl; scripts; code',
    'This is a very nice book.',
    18,
    'A visual approach to learning Perl and CGI scripting.'
);

INSERT INTO books (title, authors, category, price, book_date, keywords, notes, recomendation, description)
VALUES (
    'Teach Yourself ColdFusion in 21 Days',
    'Charles Mohnike',
    'HTML & Web design',
    31.99,
    '2009-06-01',
    'Client; scripts; code',
    'This is a meager book.',
    1,
    'A step-by-step guide to ColdFusion development.'
);

INSERT INTO books (title, authors, category, price, book_date, keywords, notes, recomendation, description)
VALUES (
    'ColdFusion Fast & Easy Web Development',
    'T. C., III Bradley',
    'HTML & Web design',
    31.99,
    '2009-06-01',
    'ColdFusion; scripts; code',
    'This is a meager book.',
    1,
    'A visual guide to ColdFusion web application development.'
);
