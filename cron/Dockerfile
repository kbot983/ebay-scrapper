FROM ubuntu:latest
MAINTAINER docker@ekito.fr

RUN apt-get update && apt-get -y install cron curl dos2unix

# Copy hello-cron file to the cron.d directory
COPY hello-cron /etc/cron.d/hello-cron

#Make it in unix format
RUN dos2unix /etc/cron.d/hello-cron

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/hello-cron

# Apply cron job
RUN crontab /etc/cron.d/hello-cron

# Run the command on container startup
CMD ["cron", "-f"]
