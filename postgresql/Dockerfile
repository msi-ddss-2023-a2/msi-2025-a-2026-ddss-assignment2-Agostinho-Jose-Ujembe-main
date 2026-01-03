#
# Authors: Agostinho Jose Ujembe <uc2025135102@student.uc.pt>
#
# DDSS 2025/2026 - PostgreSQL Container
#

FROM postgres:15

ENV POSTGRES_DB=ddss
ENV POSTGRES_USER=ddss
ENV POSTGRES_PASSWORD=ddss


COPY ddss-db-schema-pg.sql /docker-entrypoint-initdb.d/
