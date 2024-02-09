import { Header } from "../../components/header";
import { Title, Container, Box } from "@mantine/core";
import { Content } from "../../components/content";

function ContentLayout({ main, titleTop }) {
    return (
      <div>
        <div>
            <Header py={15} logoSize={60}>
                <Header.Search />
            </Header>

            <Container size="xl">
                <Box py={40}>
                    <Title fz="xl">{titleTop}</Title>
                </Box>
            </Container>
        </div>
        <main>
            <Container size="xl">
                <Content>
                    {main}
                </Content>
            </Container>
        </main>
      </div>
    );
}

export default ContentLayout;