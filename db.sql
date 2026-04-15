-- WARNING: This schema is for context only and is not meant to be run.
-- Table order and constraints may not be valid for execution.

CREATE TABLE public.carousel_photo (
  id bigint NOT NULL DEFAULT nextval('carousel_photo_id_seq'::regclass),
  imageUrl character varying NOT NULL,
  caption character varying,
  order integer NOT NULL DEFAULT 0,
  created_at timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT carousel_photo_pkey PRIMARY KEY (id)
);
CREATE TABLE public.document (
  id integer NOT NULL DEFAULT nextval('document_id_seq'::regclass),
  title character varying NOT NULL,
  description text,
  file_url character varying NOT NULL,
  file_name character varying NOT NULL,
  file_size integer NOT NULL,
  file_type character varying NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp with time zone NOT NULL,
  category text,
  CONSTRAINT document_pkey PRIMARY KEY (id)
);
CREATE TABLE public.post (
  id bigint NOT NULL DEFAULT nextval('post_id_seq'::regclass),
  title character varying NOT NULL,
  slug character varying NOT NULL,
  content jsonb NOT NULL,
  thumbnail character varying,
  document character varying,
  published boolean NOT NULL DEFAULT false,
  created_at timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp with time zone NOT NULL,
  author_id uuid NOT NULL,
  CONSTRAINT post_pkey PRIMARY KEY (id),
  CONSTRAINT post_author_id_fkey FOREIGN KEY (author_id) REFERENCES public.user(id)
);
CREATE TABLE public.post_tag (
  post_id bigint NOT NULL,
  tag_id integer NOT NULL,
  assigned_at timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT post_tag_pkey PRIMARY KEY (post_id, tag_id),
  CONSTRAINT post_tag_post_id_fkey FOREIGN KEY (post_id) REFERENCES public.post(id),
  CONSTRAINT post_tag_tag_id_fkey FOREIGN KEY (tag_id) REFERENCES public.tag(id)
);
CREATE TABLE public.tag (
  id integer NOT NULL DEFAULT nextval('tag_id_seq'::regclass),
  name character varying NOT NULL,
  slug character varying NOT NULL,
  type USER-DEFINED NOT NULL DEFAULT 'CATEGORY'::tag_type,
  created_at timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT tag_pkey PRIMARY KEY (id)
);
CREATE TABLE public.user (
  id uuid NOT NULL DEFAULT gen_random_uuid(),
  email character varying NOT NULL,
  name text NOT NULL,
  password text NOT NULL,
  role USER-DEFINED NOT NULL,
  created_at timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp with time zone NOT NULL,
  CONSTRAINT user_pkey PRIMARY KEY (id)
);