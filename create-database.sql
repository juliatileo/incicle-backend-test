CREATE DATABASE incicle_test;

CREATE TABLE states (
	id SERIAL NOT NULL,
  	name VARCHAR (2) UNIQUE NOT NULL,
  	created_at TIMESTAMP NOT NULL,
  	updated_at TIMESTAMP NOT NULL,
  	deleted_at TIMESTAMP,
  	PRIMARY KEY (id)
);

CREATE TABLE cities (
  	id SERIAL NOT NULL,
  	name VARCHAR (50) UNIQUE NOT NULL,
  	state_id INT NOT NULL,
  	created_at TIMESTAMP NOT NULL,
  	updated_at TIMESTAMP NOT NULL,
  	deleted_at TIMESTAMP,
    PRIMARY KEY (id),
  	FOREIGN KEY (state_id) REFERENCES states (id)
);

CREATE TABLE users (
	id SERIAL NOT NULL,
  	name VARCHAR (50) NOT NULL,
  	cpf VARCHAR (11) UNIQUE NOT NULL,
  	state VARCHAR (50) NOT NULL,
  	city VARCHAR (50) NOT NULL,
  	created_at TIMESTAMP NOT NULL,
  	updated_at TIMESTAMP NOT NULL,
  	deleted_at TIMESTAMP,
  	PRIMARY KEY (id)
);

CREATE TABLE logs (
	id SERIAL NOT NULL,
  	function VARCHAR (20) NOT NULL,  	
  	created_at TIMESTAMP NOT NULL,
  	updated_at TIMESTAMP NOT NULL,
  	deleted_at TIMESTAMP,
 	PRIMARY KEY (id)
);