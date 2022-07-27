#!/bin/bash

header="Content-Type: application/json"

# env
apk add -U openssl curl tar gzip bash ca-certificates git
#wget -q -O /etc/apk/keys/sgerrand.rsa.pub https://raw.githubusercontent.com/sgerrand/alpine-pkg-glibc/master/sgerrand.rsa.pub
#wget https://github.com/sgerrand/alpine-pkg-glibc/releases/download/2.23-r3/glibc-2.23-r3.apk
wget http://d.dev.response.ru/glibc-2.23-r3.apk
apk add glibc-2.23-r3.apk
rm glibc-2.23-r3.apk
#curl -L -o /usr/bin/kubectl https://storage.googleapis.com/kubernetes-release/release/v1.8.1/bin/linux/amd64/kubectl
curl -L -o /usr/bin/kubectl http://d.dev.response.ru/kubectl
chmod +x /usr/bin/kubectl
kubectl version --client
mkdir ~/.kube
curl http://kub-yaml-generator.kubernetes.local/config > ~/.kube/config

#kub yaml
request_body=$(< <(cat <<EOF
{
        "name": "$1",
        "namespace": "$NAMESPACE",
        "replicas": 1,
		"claim_name": "$1",
		"volume_name": "$1",
        "containers": [
                {
                        "name": "$1",
                        "image": "$CI_REGISTRY_IMAGE:latest",
                        "image_pull_secrets": "gitlab",
						"mount_path": "/var/www/storage/app/external",
						"volume_name": "$1",
                        "ports": [
                                80
                        ]
                }
        ]
}
EOF
))
curl  -X POST -H "$header" -d "$request_body"  http://kub-yaml-generator.kubernetes.local/deployment/claim > deployment.yaml
cat deployment.yaml

request_body=$(< <(cat <<EOF
{
	"name": "$1",
	"namespace": "$NAMESPACE",
	"ports": [
		{
			"port": 80,
			"target_port": 80,
			"selector": "$1"
		}
	]
}
EOF
))
curl  -X POST -H "$header" -d "$request_body"  http://kub-yaml-generator.kubernetes.local/service/nodeport > service.yaml
cat service.yaml

request_body=$(< <(cat <<EOF
{
	"name": "$1",
	"namespace": "$NAMESPACE",
	"host": "$1.$DOMAIN",
	"service_name": "$1",
	"service_port": $INGRESS_PORT
}
EOF
))
curl  -X POST -H "$header" -d "$request_body"  http://kub-yaml-generator.kubernetes.local/ingress > ingress.yaml
cat ingress.yaml



request_body=$(< <(cat <<EOF
{
	"kind": "Namespace",
	"apiVersion": "v1",
	"metadata": {
		"name": "$NAMESPACE",
		"labels": {
			"name": "$NAMESPACE"
		}
	}
}
EOF
))

echo $request_body > namespace.json
cat namespace.yaml

request_body=$(< <(cat <<EOF
{
	"name": "$1",
	"storage_name": "cephfs",
	"storage": $2
}
EOF
))
curl  -X POST -H "$header" -d "$request_body"  http://kub-yaml-generator.kubernetes.local/claim > claim.yaml
cat claim.yaml

# namespace && secrets
kubectl get namespace $NAMESPACE || kubectl create -f namespace.json
kubectl create secret docker-registry gitlab --docker-server=gitlab.russiadirect.ru:4567 --docker-username=$PULL_USER --docker-password=$PULL_TOKEN  --docker-email=kubernetes@russiadirect.ru --namespace=$NAMESPACE --dry-run -o yaml | kubectl replace -n "$NAMESPACE" --force -f -

#volume claim ceph rbd
kubectl  get pvc $1 --namespace=$NAMESPACE || kubectl create -f claim.yaml --namespace=$NAMESPACE

#deploy
kubectl get deployments $1 --namespace=$NAMESPACE || kubectl create -f deployment.yaml -f service.yaml -f ingress.yaml
kubectl set image deployment/$1 $1=$CI_REGISTRY_IMAGE:latest --namespace=$NAMESPACE
sleep 10
kubectl set image deployment/$1 $1=$CI_REGISTRY_IMAGE --namespace=$NAMESPACE