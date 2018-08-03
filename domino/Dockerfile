FROM ubuntu:16.04
ENV DOMINO_RELEASE=1.59.0.1
ENV DOMINO_REFRESHED_AT=20170621-0823

USER root

RUN \
export CUDA_HOME=/usr/local/cuda-7.5 && \
export CUDA_ROOT="/usr/local/cuda-7.5/bin" && \
export PATH=/usr/local/cuda-7.5/bin:$PATH && \
export LD_LIBRARY_PATH=/usr/local/cuda-7.5/lib64 && \
echo "deb http://developer.download.nvidia.com/compute/machine-learning/repos/ubuntu1404/x86_64 /" > /etc/apt/sources.list.d/nvidia-ml.list && \
apt-get --allow-unauthenticated update && apt-get install --force-yes -y --no-install-recommends libcudnn5=5.1.3-1+cuda7.5 libcudnn5-dev=5.1.3-1+cuda7.5 && rm -rf /var/lib/apt/lists/* && \

pip install 'certifi==2015.4.28' --force-reinstall && \
export TF_BINARY_URL=https://storage.googleapis.com/tensorflow/linux/gpu/tensorflow-0.10.0-cp27-none-linux_x86_64.whl && \
pip install --ignore-installed  --upgrade $TF_BINARY_URL && \
pip install keras

RUN sudo apt-get update 
RUN apt-get install -y libhdf5-dev libyaml-dev pkg-config  libopencv-dev python-opencv 

RUN \
export CUDA_ROOT="/usr/local/cuda-7.5/bin"  && \
export PATH=/usr/local/cuda-7.5/bin:$PATH && \
export LD_LIBRARY_PATH="/usr/local/cuda-7.5/lib64:/usr/local/cuda-7.5/lib:/usr/local/lib:" && \

apt-get install -y python-virtualenv && \
pip install --upgrade six && \
cd ~ && \
git clone https://github.com/NervanaSystems/neon.git && \
cd neon && \
 # export PATH=/usr/local/cuda-7.5/bin:$PATH && \
  make sysinstall HAS_GPU=true


# Update R
RUN apt-get update && apt-get install -y r-base r-base-dev
RUN R -e 'install.packages(c("data.table","ggfortify","gridExtra","sitools","shinydashboard","shinyjs"),repos="http://cran.us.r-project.org")'

# Update R Studio
RUN cd /tmp && wget http://download2.rstudio.org/rstudio-server-1.0.153-amd64.deb && dpkg -i rstudio-server-1.0.153-amd64.deb && rm rstudio-server-1.0.153-amd64.deb && R -e 'install.packages(c("evaluate","knitr","base64enc","rmarkdown"),repos="http://cran.us.r-project.org")'
RUN echo "www-frame-origin=app.dominodatalab.com" >> /etc/rstudio/rserver.conf && chown ubuntu:ubuntu /etc/rstudio/rserver.conf

# Set correct and global CRAN mirror
RUN printf 'options(repos=structure(c(CRAN="https://cran.r-project.org")))' >> /home/ubuntu/.Rprofile && printf 'options(repos=structure(c(CRAN="https://cran.r-project.org")))' >> /etc/Rprofile.site

RUN pip install awscli boto3

# Upgrade pip and correctly chown the cache directory
RUN pip install --upgrade pip && chown -R ubuntu:ubuntu /home/ubuntu/.cache/pip/http

RUN R -e 'install.packages(c("httr","xml2","Cairo"), repos="https://cran.r-project.org")' && R -e 'install.packages("aws.s3", repos = c("cloudyr" = "http://cloudyr.github.io/drat"))'

# for MM VULC-366
RUN pip install flask==0.12 jsonify==0.5 uwsgi==2.0.14
