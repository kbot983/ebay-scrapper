FROM python
ADD app.py /
ADD test.py /
COPY requirements.txt ./
ENV TZ 'America/New_York'
RUN pip install --no-cache-dir -r requirements.txt &&\
    echo $TZ > /etc/timezone && \
    apt-get update && apt-get install -y tzdata && \
    rm /etc/localtime && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata && \
    apt-get clean && \
    date
# CMD ["python", "./app.py"] 
CMD ["python","test.py"]
