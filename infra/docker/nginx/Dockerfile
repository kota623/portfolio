FROM node:14.2-alpine as node
FROM nginx:1.18-alpine
SHELL ["/bin/ash", "-oeux", "pipefail", "-c"]

ENV TZ=UTC

RUN apk update \
    && apk upgrade \
    && apk add --update --no-cache --virtual=.build-dependencies g++ \
    && apk add --no-cache openssl \
    && apk add --no-cache certbot \
    && apk add --no-cache bash

#CMD ["certbot certonly --agree-tos --webroot -w /work/backend/public -d expensive.cloud", "2"]

# node command
COPY --from=node /usr/local/bin /usr/local/bin
# npm command
COPY --from=node /usr/local/lib /usr/local/lib
# yarn command
COPY --from=node /opt /opt
# nginx config file
COPY ./default.conf /etc/nginx/conf.d/default.conf

WORKDIR /work/backend
