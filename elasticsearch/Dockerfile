#https://gitlab.comwork.io/oss/elasticstack/elasticstack-arm
ARG BALENA_DEBIAN_TAG=buster
ARG BALENA_DEBIAN_DIGEST=sha256:b32c2579e735f8257211c9b2c2eeab6db199907e138380833dbe2515cc6878e3

FROM balenalib/raspberrypi3-debian:${BALENA_DEBIAN_TAG}@${BALENA_DEBIAN_DIGEST} AS base

ENV ES_VERSION=7.16.1 \
    ES_OS=linux \
    ES_ARCH=x86_64 \
    ES_EXEC=elasticsearch \
    ES_HOST=0.0.0.0 \
    ES_NODE_NAME=elasticsearch \
    ES_DISCOVERY_TYPE=single-node \
    ES_HEAP=2g \
    ES_TRANSPORT_PORT=9300 \
    ES_HTTP_PORT=9200 \
    JAVA_VERSION=11 \
    ES_HOME=/usr/share/elasticsearch

COPY elastic_env.sh ./elastic_start.sh ./elastic_init.sh /

ARG PI_UID=1000
ARG PI_GID=1000

RUN groupadd elasticsearch -g $PI_GID && \
  useradd -rm -d /home/elasticsearch -s /bin/bash -g elasticsearch -G root,sudo -u $PI_UID elasticsearch && \
  echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers && \
  sed -i "s/VAL_ES_HOME/$(echo ${ES_HOME}|sed "s/\//\\\\\//g")/g;s/VAL_JAVA_VERSION/${JAVA_VERSION}/g;s/VAL_ES_HOST/${ES_HOST}/g;s/VAL_ES_ARCH/${ES_ARCH}/g" /elastic_env.sh && \
  sed -i "s/VAL_ES_VERSION/${ES_VERSION}/g;s/VAL_ES_DISCOVERY_TYPE/${ES_DISCOVERY_TYPE}/g;s/VAL_ES_HTTP_PORT/${ES_HTTP_PORT}/g;s/VAL_ES_OS/${ES_OS}/g" /elastic_env.sh && \
  sed -i "s/VAL_ES_NODE_NAME/${ES_NODE_NAME}/g;s/VAL_ES_HEAP/${ES_HEAP}/g;s/VAL_ES_TRANSPORT_PORT/${ES_TRANSPORT_PORT}/g;s/VAL_ES_EXEC/${ES_EXEC}/g" /elastic_env.sh && \
  chmod +x /elastic_env.sh && \
  chmod +x /elastic_start.sh && \
  chmod +x /elastic_init.sh && \
  apt-get update && \
  apt-get -qy install bash curl ca-certificates openjdk-$JAVA_VERSION-jdk openjdk-$JAVA_VERSION-jre && \
  curl -fsSL https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-$ES_VERSION-$ES_OS-$ES_ARCH.tar.gz -o elasticsearch.tgz && \
  tar xvzf elasticsearch.tgz > /dev/null 2>&1 && \
  mv elasticsearch-$ES_VERSION $ES_HOME && \
  echo "-Xlog:disable" >> $ES_HOME/gc.options && \
  rm -rf elasticsearch.tgz && \
  sed -i "s/Xms1g/Xms$ES_HEAP/g;s/Xmx1g/Xmx$ES_HEAP/g" $ES_HOME/config/jvm.options && \
  echo $ES_EXEC -E node.name=$ES_NODE_NAME -E cluster.name=$ES_NODE_NAME -E transport.tcp.port=$ES_TRANSPORT_PORT -E transport.host=$ES_HOST -E http.port=$ES_HTTP_PORT -E network.host=$ES_HOST -E discovery.type=$ES_DISCOVERY_TYPE -E xpack.security.enabled=false -E xpack.ml.enabled=false -E xpack.graph.enabled=false -E xpack.monitoring.enabled=false -E xpack.enrich.enabled=false -E xpack.watcher.enabled=false > $ES_HOME/es_start.sh && \
  chmod +x $ES_HOME/es_start.sh && \
  chown -R elasticsearch:elasticsearch $ES_HOME && \
  chmod -R 755 $ES_HOME && \
  apt-get remove -qy curl

EXPOSE 9200 9300

VOLUME [ "/usr/share/elasticsearch/data" ]

CMD [ "/elastic_init.sh" ]
