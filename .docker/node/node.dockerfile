FROM node:16-alpine

WORKDIR /var/www
RUN npm i -g npm
RUN chown -Rh node:node /var/www

USER node

EXPOSE 5173

CMD [ "sh", "-c", "npm install && npm run build && npm run dev" ]